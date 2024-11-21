<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\MatriculeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegisterController extends AbstractController
{
    private $verifyEmailHelper;
    private $mailer;

    public function __construct(VerifyEmailHelperInterface $verifyEmailHelper, MailerInterface $mailer)
    {
        $this->verifyEmailHelper = $verifyEmailHelper;
        $this->mailer = $mailer;
    }

    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        ValidatorInterface $validator,
        UserRepository $userRepository,
        MatriculeRepository $matriculeRepository
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

       
        // Validation des champs requis
        if (!isset($data['email'], $data['password'], $data['firstName'], $data['lastName'], $data['identifiant'], $data['matricule'])) {
            return new JsonResponse(['message' => 'Tous les champs requis doivent être renseignés.'], 400);
        }

        // Vérification que l'identifiant est unique
        if ($userRepository->findOneBy(['identifiant' => $data['identifiant']])) {
            return new JsonResponse(['message' => 'Cet identifiant est déjà utilisé.'], 400);
        }

        // Vérification que le matricule existe
        $matricule = $matriculeRepository->findOneBy(['matricule' => $data['matricule']]);
        if (!$matricule) {
            return new JsonResponse(['message' => 'Matricule invalide.'], 400);
        }

        // Création de l'utilisateur
        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setIdentifiant($data['identifiant']);
        $user->setMatricule($matricule);

        // Validation de l'entité User
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['message' => implode(", ", $errorMessages)], 400);
        }

        // Sauvegarde de l'utilisateur
        $entityManager->persist($user);
        $entityManager->flush();

        // Génération du lien de vérification
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            'api_verify_email',
            (string) $user->getId(),
            $user->getEmail(),
            ['id' => $user->getId()]
        );

        $verificationUrl = $signatureComponents->getSignedUrl();

        // Envoi de l'email de vérification
        $email = (new Email())
            ->from('noreply@yourdomain.com')
            ->to($user->getEmail())
            ->subject('Veuillez vérifier votre email')
            ->html(sprintf('<p>Merci de confirmer votre adresse email en cliquant <a href="%s">ici</a>.</p>', $verificationUrl));

        $this->mailer->send($email);

        return new JsonResponse(['message' => 'Utilisateur créé avec succès. Veuillez vérifier votre email.'], 201);
    }

    #[Route('/api/verify/email', name: 'api_verify_email', methods: ['GET'])]
    public function verifyUserEmail(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $id = $request->query->get('id');

        if (null === $id) {
            return new JsonResponse(['message' => 'L\'ID utilisateur est requis'], 400);
        }

        $user = $userRepository->find($id);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], 404);
        }

        try {
            $this->verifyEmailHelper->validateEmailConfirmationFromRequest($request, (string) $user->getId(), $user->getEmail());
            $user->setIsVerified(true);
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (VerifyEmailExceptionInterface $e) {
            return new JsonResponse(['message' => 'Erreur de vérification : ' . $e->getReason()], 400);
        }

        return new JsonResponse(['message' => 'Email vérifié avec succès.'], 200);
    }
}

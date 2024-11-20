<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Entity\Loan;
use Doctrine\Persistence\Event\LifecycleEventArgs as EventLifecycleEventArgs;

class EntityTimestampListener
{
    public function prePersist(EventLifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // Vérifiez si c'est une instance de l'entité concernée
        if (!$entity instanceof Loan) {
            return;
        }

        // Définir la date de création uniquement lors de l'insertion
        if (method_exists($entity, 'setLoanAt')) {
            $entity->setLoanAt(new \DateTimeImmutable());
        }
    }

    public function preUpdate(EventLifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // Vérifiez si c'est une instance de l'entité concernée
        if (!$entity instanceof Loan) {
            return;
        }

        // Mettre à jour uniquement la date de mise à jour
        if (method_exists($entity, 'setReturnAt')) {
            $entity->setReturnAt(new \DateTimeImmutable());
        }
    }
}


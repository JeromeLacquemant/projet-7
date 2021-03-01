<?php

declare(strict_types=1);

namespace App\Events;

use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class UserSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove,
        ];
    }

    public function postPersist(LifecycleEventArgs $args) 
    {
        dd($args);
    }

    public function postUpdate(LifecycleEventArgs $args) 
    {
        dd($args);
    }

    public function postRemove(LifecycleEventArgs $args) 
    {
        dd($args);
    }
}
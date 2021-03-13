<?php

// src/Security/PostVoter.php
namespace App\Security\Voter;

use App\Entity\User;
use App\Entity\Client;
use Exception;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserVoter extends Voter
{
    
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';

    protected function supports(string $attribute, $subject)
    {
        
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        // only vote on `User` objects
        if (!$subject instanceof User) {
            return false;
        }
        
        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $client = $token->getUser();
        
        if (!$client instanceof Client) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a User object, thanks to `supports()`
        /** @var User $user */
        $user = $subject;

        switch ($attribute) {
            case self::VIEW:   
                return $this->canView($user, $client);
            case self::EDIT:
                return $this->canEdit($user, $client);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(User $user, Client $client)
    {
        // if they can edit, they can view
        if ($this->canEdit($user, $client)) {
            return true;
        } else {
            throw new Exception('Vous netes pas autorisé');
        }
    }

    private function canEdit(User $user, Client $client)
    {
        return $client === $user->getClient();
    }
}


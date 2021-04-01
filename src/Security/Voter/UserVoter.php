<?php

// src/Security/PostVoter.php

namespace App\Security\Voter;

use App\Entity\Client;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports(string $attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::DELETE])) {
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
            case self::DELETE:
                return $this->canDelete($user, $client);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(User $user, Client $client)
    {
        // if they can edit, they can view
        if ($this->canEdit($user, $client)) {
            return true;
        }
    }

    private function canEdit(User $user, Client $client)
    {
        return $client === $user->getClient();
    }

    private function canDelete(User $user, Client $client)
    {
        return $client === $user->getClient();
    }
}

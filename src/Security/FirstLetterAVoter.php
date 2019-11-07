<?php


namespace App\Security;


use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class FirstLetterIsAVoter extends Voter
{

    protected function supports($attribute, $subject)
    {
        return $attribute === 'firstLetter' && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        return false !== stripos($token->getUser()->getUsername(), 'a');
    }
}
<?php


namespace App\Security;


use App\Entity\Order;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class MyOrderVoter extends Voter
{

private $security;

public function __construct(Security $security)
{
$this->security = $security;
}


/**
* Determines if the attribute and subject are supported by this voter.
*
* @param string $attribute An attribute
* @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
*
* @return bool True if the attribute and subject are supported, false otherwise
*/
protected function supports($attribute, $subject)
{
// TODO: Implement supports() method.
return $attribute === 'orderAccess' && $subject instanceof Order;
}

/**
* Perform a single access check operation on a given attribute, subject and token.
* It is safe to assume that $attribute and $subject already passed the "supports()" method check.
*
* @param string $attribute
* @param mixed $subject
*
* @return bool
*/
protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
{
// TODO: Implement voteOnAttribute() method.
return $subject->getName() === $token->getUsername() ||
$this->security->isGranted('ROLE_ADMIN', $token->getUser());
}
}
<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\HttpFoundation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class DefaultController
{
    public function index(Request $request, AuthorizationCheckerInterface $authorizationChecker, TokenStorageInterface $tokenStorage)
    {
        $user  = $tokenStorage->getToken()->getUser();
        if($authorizationChecker->isGranted('firstLetter', $user))
        return new Response('Hello benji');

    }
}

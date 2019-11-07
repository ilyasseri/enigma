<?php

namespace App\Controller;

use App\Entity\Order;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Twig\Environment;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersDetail
{
    public function __invoke(Environment $twig, Order $order, AuthorizationCheckerInterface $authorizationChecker): Response
    {
        if(!$authorizationChecker->isGranted('orderAccess', $order)) {
            throw  new AccessDeniedException();
        }
        return new Response(
            $twig->render('orders/ordersDetail.html.twig',[
                'order' => $order
            ])
        );
    }
}
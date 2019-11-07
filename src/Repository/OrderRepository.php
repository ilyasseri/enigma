<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class OrderRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry){
        parent::__construct($registry, Order::class);
    }

    public function save(?Order $order = null): void{
        $this->getEntityManager()->flush($order);
    }

    public function persistAndSave(?Order $order = null): void{
        $this->getEntityManager()->persist($order);
        $this->save($order);
    }

}

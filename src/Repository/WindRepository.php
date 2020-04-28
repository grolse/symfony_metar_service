<?php

namespace App\Repository;

use App\Entity\Wind;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wind|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wind|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wind[]    findAll()
 * @method Wind[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WindRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wind::class);
    }


    public function save(Wind $weather)
    {
        $em = $this->getEntityManager();

        $em->persist($weather);
        $em->flush();
    }
}

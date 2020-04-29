<?php

namespace App\Repository;

use App\Entity\Weather;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Weather|null find($id, $lockMode = null, $lockVersion = null)
 * @method Weather|null findOneBy(array $criteria, array $orderBy = null)
 * @method Weather[]    findAll()
 * @method Weather[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Weather::class);
    }

    /**
     * @param string $icao
     * @return Weather|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findWeatherByIcao(string $icao): ?Weather
    {
        return $this->createQueryBuilder('w')
            ->where('w.icaoCode = :icaoCode')
            ->setParameter('icaoCode', $icao)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findWeatherByIcaoCodes(string $icaoCodes)
    {
        return $this->createQueryBuilder('w')
            ->where('w.icaoCode IN (:icaoCodes)')
            ->setParameter('icaoCodes', $icaoCodes)
            ->getQuery()
            ->getResult();
    }

    public function save(Weather $weather)
    {
        $em = $this->getEntityManager();

        $em->persist($weather);
        $em->flush();
    }
}

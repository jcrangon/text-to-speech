<?php

namespace App\Repository;

use App\Entity\ApiData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ApiData|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiData|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiData[]    findAll()
 * @method ApiData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApiDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApiData::class);
    }

    // /**
    //  * @return ApiData[] Returns an array of ApiData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ApiData
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

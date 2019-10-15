<?php

namespace App\Repository;

use App\Entity\IbmWatsonTtsVoiceCatalog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IbmWatsonTtsVoiceCatalog|null find($id, $lockMode = null, $lockVersion = null)
 * @method IbmWatsonTtsVoiceCatalog|null findOneBy(array $criteria, array $orderBy = null)
 * @method IbmWatsonTtsVoiceCatalog[]    findAll()
 * @method IbmWatsonTtsVoiceCatalog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IbmWatsonTtsVoiceCatalogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IbmWatsonTtsVoiceCatalog::class);
    }

    // /**
    //  * @return TtsVoiceCatalog[] Returns an array of TtsVoiceCatalog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IbmWatsonTtsVoiceCatalog
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

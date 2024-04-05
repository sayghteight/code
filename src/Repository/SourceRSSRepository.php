<?php

namespace App\Repository;

use App\Entity\SourceRSS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SourceRSS>
 *
 * @method SourceRSS|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourceRSS|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourceRSS[]    findAll()
 * @method SourceRSS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceRSSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourceRSS::class);
    }

    //    /**
    //     * @return SourceRSS[] Returns an array of SourceRSS objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SourceRSS
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

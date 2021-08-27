<?php

namespace App\Repository;

use App\Entity\BrandM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BrandM|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrandM|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrandM[]    findAll()
 * @method BrandM[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandMRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandM::class);
    }

    // /**
    //  * @return BrandM[] Returns an array of BrandM objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BrandM
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

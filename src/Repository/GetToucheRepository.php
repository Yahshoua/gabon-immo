<?php

namespace App\Repository;

use App\Entity\GetTouche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GetTouche|null find($id, $lockMode = null, $lockVersion = null)
 * @method GetTouche|null findOneBy(array $criteria, array $orderBy = null)
 * @method GetTouche[]    findAll()
 * @method GetTouche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GetToucheRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GetTouche::class);
    }

    // /**
    //  * @return GetTouche[] Returns an array of GetTouche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GetTouche
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Appartement;
use App\Entity\Types;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Appartement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appartement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appartement[]    findAll()
 * @method Appartement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppartementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Appartement::class);
    }
        // /**
    //  * @return Appartement[] Returns an array of Appartement objects
    //  */
        public function findByAnnexes($value, $id)
        {
            return $this->createQueryBuilder('a')
                ->Where("a.category =:val")
                ->andWhere('a.id !=:id')
                ->setParameter('val', $value)
                ->setParameter('id', $id)
                ->orderBy('a.id', 'ASC')
                ->setMaxResults(3)
                ->getQuery()
                ->getResult()
            ;
        }
        public function findByWord($type, $cat, $word) {
            return $this->createQueryBuilder('a')
            ->join(Types::class, 't')
            ->Where('t.id =:type')
            ->andWhere('a.category =:cat')
            ->andWhere('a.commentaire LIKE :word OR a.ville LIKE :word')
            ->setParameter('type', $type)
            ->setParameter('cat', $cat)
            ->setParameter('word', '%'.$word.'%')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
        }
    // /**
    //  * @return Appartement[] Returns an array of Appartement objects
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
    public function findOneBySomeField($value): ?Appartement
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

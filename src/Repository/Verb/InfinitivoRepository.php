<?php

namespace App\Repository\Verb;

use App\Entity\Verb\Infinitivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Infinitivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Infinitivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Infinitivo[]    findAll()
 * @method Infinitivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfinitivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Infinitivo::class);
    }

    // /**
    //  * @return Infinitivo[] Returns an array of Infinitivo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Infinitivo
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

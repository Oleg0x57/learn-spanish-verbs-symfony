<?php

namespace App\Repository\Verb;

use App\Entity\Verb\AbstractTimeForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AbstractTimeForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbstractTimeForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbstractTimeForm[]    findAll()
 * @method AbstractTimeForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AbstractTimeForm::class);
    }

    // /**
    //  * @return AbstractTimeForm[] Returns an array of AbstractTimeForm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AbstractTimeForm
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

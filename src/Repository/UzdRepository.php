<?php

namespace App\Repository;

use App\Entity\Uzd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Uzd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uzd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uzd[]    findAll()
 * @method Uzd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UzdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Uzd::class);
    }

//    /**
//     * @return Uzd[] Returns an array of Uzd objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Uzd
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

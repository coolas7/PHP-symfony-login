<?php

namespace App\Repository;

use App\Entity\Vart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vart[]    findAll()
 * @method Vart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VartRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vart::class);
    }

//    /**
//     * @return Vart[] Returns an array of Vart objects
//     */
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
    public function findOneBySomeField($value): ?Vart
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

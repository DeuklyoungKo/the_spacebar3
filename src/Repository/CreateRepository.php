<?php

namespace App\Repository;

use App\Entity\Create;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Create|null find($id, $lockMode = null, $lockVersion = null)
 * @method Create|null findOneBy(array $criteria, array $orderBy = null)
 * @method Create[]    findAll()
 * @method Create[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Create::class);
    }

    // /**
    //  * @return Create[] Returns an array of Create objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Create
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

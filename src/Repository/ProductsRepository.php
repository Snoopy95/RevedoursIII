<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Products[]    findByCate($id)
 * @method Products[]    findNews($nb day)
 * @method Products[]    findsold()
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }

    // /**
    //  * @return Products[] Returns an array of Products objects by category
    //  */
    public function findByCate($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.categories = :val', 'p.prod_stock = 1', 'p.Orders IS NULL')
            ->setParameter('val', $value)
            ->orderBy('p.prod_datecreat', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Products[] qui on moins d'x jours
    //  */
    public function findNews($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.prod_datecreat >= :date', "p.prod_stock = 1", "p.Orders IS NULL")
            ->setParameter('date', new \Datetime('- '.$value.' day'))
            ->orderBy('p.prod_datecreat', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Products[] Returns an array of Products by order
    //  */
    public function findsold()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.prod_stock = 1', 'p.Orders IS NOT NULL')
            ->orderBy('p.prod_datecreat', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Products[] Returns an array of Products objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Products
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

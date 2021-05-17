<?php

namespace App\Repository;

use App\Entity\Car;
use App\Entity\SearchCar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function findAllWithPaginator(SearchCar $searchCar): Query
    {
        $req = $this->createQueryBuilder('c');
        if ($searchCar->getMinYear()) {
            $req = $req->andWhere('c.year >= :minYear')
                ->setParameter(':minYear', $searchCar->getMinYear());
        }
        if ($searchCar->getMaxYear()) {
            $req = $req->andWhere('c.year <= :maxYear')
                ->setParameter(':maxYear', $searchCar->getMaxYear());
        }
        if ($searchCar->getImmatriculation()) {
            $req = $req->andWhere('c.immatriculation LIKE :immatriculation')
                ->setParameter(':immatriculation', '%' . $searchCar->getImmatriculation() . '%');
        }
        return  $req->getQuery();
    }

    // /**
    //  * @return Car[] Returns an array of Car objects
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
    public function findOneBySomeField($value): ?Car
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

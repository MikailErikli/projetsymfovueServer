<?php

namespace App\Repository;

use App\Entity\Pin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pin[]    findAll()
 * @method Pin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pin::class);
    }

    /**
     * Retourne une liste de pin pour l'api
     */
    public function apiFindAll() : array
    {
        return $this->createQueryBuilder('p')
            ->select('p.id', 'p.title', 'p.description')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Pin[] Returns an array of Pin objects
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
    public function findOneBySomeField($value): ?Pin
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

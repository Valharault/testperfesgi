<?php

namespace App\Repository;

use App\Entity\ActorRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActorRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActorRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActorRole[]    findAll()
 * @method ActorRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActorRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActorRole::class);
    }

    // /**
    //  * @return ActorRole[] Returns an array of ActorRole objects
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
    public function findOneBySomeField($value): ?ActorRole
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

<?php

namespace App\Repository;

use App\Entity\FilmGenres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FilmGenres|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilmGenres|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilmGenres[]    findAll()
 * @method FilmGenres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmGenresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FilmGenres::class);
    }

    // /**
    //  * @return FilmGenres[] Returns an array of FilmGenres objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FilmGenres
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

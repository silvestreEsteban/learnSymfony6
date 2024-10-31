<?php

namespace App\Repository;

use App\Entity\VinylMix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VinylMix>
 */
class VinylMixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VinylMix::class);
    }

        /**
         * @return VinylMix[] Returns an array of VinylMix objects
         */
        public function findByExampleField($value): array
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

    //    public function findOneBySomeField($value): ?VinylMix
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

        public function findAllOrderedByVotes(string $genre = null): array
        {
            $queryBuilder = $this->addOrderByVotesQueryBuilder();

            if($genre){
                $queryBuilder->andWhere('mix.genre = :genre')
                ->setParameter('genre', $genre);
            }

            return $queryBuilder
                ->getQuery()
                ->getResult();
        }

        private function addOrderByVotesQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
        {
            $queryBuilder = $queryBuilder ?? $this->createQueryBuilder('mix');

            return $queryBuilder->orderBy('mix.votes', 'DESC');
        }



}

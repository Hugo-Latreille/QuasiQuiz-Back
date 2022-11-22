<?php

namespace App\Repository;

use App\Entity\GameHasQuestions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameHasQuestions>
 *
 * @method GameHasQuestions|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameHasQuestions|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameHasQuestions[]    findAll()
 * @method GameHasQuestions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameHasQuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameHasQuestions::class);
    }

    public function save(GameHasQuestions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GameHasQuestions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GameHasQuestions[] Returns an array of GameHasQuestions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GameHasQuestions
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

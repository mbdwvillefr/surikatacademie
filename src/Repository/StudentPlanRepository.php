<?php

namespace App\Repository;

use App\Entity\StudentPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StudentPlan>
 *
 * @method StudentPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentPlan[]    findAll()
 * @method StudentPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentPlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentPlan::class);
    }

//    /**
//     * @return StudentPlan[] Returns an array of StudentPlan objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StudentPlan
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\DemonstrationRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DemonstrationRequest>
 *
 * @method DemonstrationRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemonstrationRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemonstrationRequest[]    findAll()
 * @method DemonstrationRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemonstrationRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemonstrationRequest::class);
    }

//    /**
//     * @return DemonstrationRequest[] Returns an array of DemonstrationRequest objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DemonstrationRequest
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

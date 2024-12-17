<?php

namespace App\Repository;

use App\Entity\Fournisseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fournisseur>
 *
 * @method Fournisseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fournisseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fournisseur[]    findAll()
 * @method Fournisseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FournisseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fournisseur::class);
    }

//    /**
//     * @return Fournisseur[] Returns an array of Fournisseur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Fournisseur
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findAllWithDocuments(): array
    {
        return $this->createQueryBuilder('f')
            ->leftJoin('f.documents', 'd')
            ->addSelect('d')
            ->where('d.id IS NOT NULL') // S'assure que le fournisseur a au moins un document
            ->addOrderBy('CASE WHEN f.libelle = :specialLibelle THEN 0 ELSE 1 END', 'ASC')
            ->addOrderBy('f.orderDisplay', 'ASC')
            ->setParameter('specialLibelle', 'Marconnet Technologies™')
            ->getQuery()
            ->getResult();
    }


    /**
     * Récupère tous les fournisseurs dans l'ordre d'affichage voulu par le tri
     * Les NULL dans orderDisplay sont placés en dernier.
     */
    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('f')
            ->where('f.isVisibleOnAboutPage = true')
            ->addOrderBy('CASE WHEN f.orderDisplay IS NULL THEN 1 ELSE 0 END', 'ASC') // NULLs last
            ->addOrderBy('f.orderDisplay', 'ASC') // Ordre croissant pour les valeurs non NULL
            ->getQuery()
            ->getResult();
    }

    /**
     * Renvoie le orderDisplay le plus élevé
     */
    public function findMaxOrderDisplay(): ?int
    {
        return $this->createQueryBuilder('f')
            ->select('MAX(f.orderDisplay)')
            ->getQuery()
            ->getSingleScalarResult();
    }


}

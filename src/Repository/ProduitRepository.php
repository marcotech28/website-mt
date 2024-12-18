<?php

namespace App\Repository;

use App\Entity\Produit;
use App\Data\SearchData;
use App\Entity\Categorie;
use App\Entity\Utilisation;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Produit>
 *
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function save(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Récupère produits en lien avec une recherche
     * @return Produit[]
     */
    public function findSearch(SearchData $search): array
    {

        $query = $this
            ->createQueryBuilder('produit')
            ->select('produit')
            ->andWhere('produit.isDraft IS NULL OR produit.isDraft = false'); // On ne prend pas les brouillons
            
        if (!empty($search->q)) {
            // On divise la chaîne de recherche en mots clés individuels
            $keywords = explode(' ', $search->q);

            // On construit une condition OR pour chaque mot clé
            $orConditions = [];
            foreach ($keywords as $index => $keyword) {
                $orConditions[] = "produit.nom LIKE :q{$index} OR produit.motsCles LIKE :q{$index}";
                $query->setParameter("q{$index}", "%{$keyword}%");
            }

            // On ajoute les conditions OR à la requête
            $query = $query->andWhere(implode(' OR ', $orConditions));
        }

        $results = $query->getQuery()->getResult();

        return $results;
    }

    // Récupère les produits par catégorie sans prendre les brouillons
    public function findByCategorieWithoutDraft(Categorie $categorie): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.categorie = :categorie')
            ->andWhere('p.isDraft = false OR p.isDraft IS NULL')
            ->setParameter('categorie', $categorie)
            ->getQuery()
            ->getResult();
    }

    public function findByCategorieAndUtilisationWithoutDraft(Categorie $categorie, Utilisation $utilisation): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.categorie = :categorie')
            ->andWhere('p.utilisation = :utilisation')
            ->andWhere('p.isDraft = false OR p.isDraft IS NULL')
            ->setParameters([
                'categorie' => $categorie,
                'utilisation' => $utilisation,
            ])
            ->getQuery()
            ->getResult();
    }

}

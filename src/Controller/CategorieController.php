<?php

namespace App\Controller;

use App\Entity\Utilisation;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    //cette injection de dépendance est faite pour les slugs, c'est à supprimer
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    #[Route('/{slug}', name: 'app_categorie', priority: -1)]
    public function categorie($slug, CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findOneBy([
            'slug' => $slug
        ]);

        if (!$categorie) { //on affiche une erreur si la catégorie n'existe pas
            throw $this->createNotFoundException(("La catégorie demandée n'existe pas"));
        }

        return $this->render('categorie/categorie.html.twig', [
            'slug' => $slug,
            'categorie' => $categorie
        ]);
    }

    //ce code est fait pr mettre à jour les slugs dans la bdd, ca sera à supprimer + tard
    /**
     * @Route("/go/slug", name="categorie_slug", priority=-1)
     */
    public function slug(EntityManagerInterface $em)
    {
        $UtilisationRepository = $em->getRepository(Utilisation::class);

        $utilisations = $UtilisationRepository->findAll();

        foreach ($utilisations as $ut) {
            $ut->setSlug(strtolower($this->slugger->slug($ut->getLibelle())));
        }

        $em->flush();

        return $this->render('categorie/categorie.html.twig', []);
    }
}

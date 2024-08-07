<?php

namespace App\Command;

use App\Entity\Image;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:manage-picture-product',
    description: 'Déplace les images des produits vers la nouvelle entité Image',
)]
class ManagePictureProductCommand extends Command
{
    private $entityManager;
    private $produitRepository;

    public function __construct(EntityManagerInterface $entityManager, ProduitRepository $produitRepository)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->produitRepository = $produitRepository;
    }
    
    protected function configure(): void
    {
        $this
            ->setDescription('Déplace les images des produits vers la nouvelle entité Image.');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $produits = $this->produitRepository->findAll();

        foreach ($produits as $produit) {
            $images = [
                $produit->getImage1(),
                $produit->getImage2(),
                $produit->getImage3(),
                $produit->getImage4(),
                $produit->getImage5(),
            ];

            foreach ($images as $imageUrl) {
                if ($imageUrl) {
                    $image = new Image();
                    $image->setUrl($imageUrl);
                    $image->setAlt($produit->getNom());
                    $image->setProduit($produit);

                    $this->entityManager->persist($image);
                }
            }

            $this->entityManager->persist($produit);
        }

        $this->entityManager->flush();

        $io->success('Les images des produits ont été déplacées vers la nouvelle entité Image.');

        return Command::SUCCESS;
    }
}

<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\User;
use App\Entity\Tags;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'app_artist')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $artist = $doctrine->getRepository(User::class)->findBy(['profil' => 'Artist']);
//        $artist = $doctrine->getRepository(User::class)->findBy(['artist' => notnull]);

        for($i = 0; $i < sizeof($artist); $i++){
            $tab[$i][0] = $artist[$i];
//            $tab[$i][1] = $artist[$i]->getTags();

            $tags2 = $artist[$i]->getArtist();
            $tab[$i][1] = $tags2->getTags();
        }
//        $tags1 = $artist[0]->getArtist();
//        $tags = $tags1->getTags();

        $gal = $artist[0]->getArtist();
        $galerie = $gal->getGalerie();

//        $artist = $artist[1]->getId();

        return $this->render('artist/index.html.twig', [
            'controller_name' => 'ArtistController',
            'artist' => $tab,
            'tags' => $galerie,
        ]);
    }
}
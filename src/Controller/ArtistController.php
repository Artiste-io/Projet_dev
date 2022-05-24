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
        $artist = $doctrine->getRepository(User::class)->findBy(
            ['profil' => 'Artist']
        );

        for($i = 0; $i < sizeof($artist); $i++){
            $tab[$i][0] = $artist[$i];
            if($artist[$i]->getArtist() == null)
            {
                $tab[$i][1] = null;
                $tab[$i][2] = null;
            }
            else
            {
                $tags2 = $artist[$i]->getArtist();
                $tab[$i][1] = $tags2->getTags();
                $tab[$i][2] = $tags2->getGalerie();
            }
        }

        return $this->render('artist/index.html.twig', [
            'controller_name' => 'ArtistController',
            'artist' => $tab,
        ]);
    }
}
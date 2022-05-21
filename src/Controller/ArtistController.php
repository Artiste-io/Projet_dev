<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'app_artist')]
    public function index(ManagerRegistry $doctrine): Response
    {
//        $artist = $doctrine->getRepository(User::class)->findAll();

        return $this->render('artist/index.html.twig', [
            'controller_name' => 'ArtistController',
//            'artist' => $artist,
        ]);
    }
}

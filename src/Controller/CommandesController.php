<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Commandes;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandesController extends AbstractController
{
    #[Route('/commandes', name: 'app_commandes')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        //$idUser = $user->getId();
        $idUser = 1; //en attendant

        $commande = $doctrine->getRepository(Commandes::class)->findBy(['client' => $idUser]);
        for ($i = 0; $i < sizeof($commande); $i++)
        {
            $artiste[$i][0] = $commande[$i];
            $artiste[$i][1] = $commande[$i]->getArtist();
        }

        return $this->render('commandes/index.html.twig', [
            'controller_name' => 'CommandesController',
            'getArtiste' => $artiste,
            //'getTags' => $tags
        ]);
    }
}

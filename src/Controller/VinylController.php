<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(): Response
    {
        $tracks = [
            ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['song' => 'Sing for the Moment', 'artist' => 'Eminem'],
            ['song' => 'Forty Six & Two', 'artist' => 'TOOL'],
            ['song' =>'Hallowed be thy Name', 'artist' =>  'Iron Maiden'],
      ];
        return $this->render('vinyl/homepage.html.twig', [
        'title' => 'Lola',
        'tracks' => $tracks,
    ]);
    }
    #[Route('browse/{slug}', name: 'app_browse')]
    public function browse(string $slug = null): Response
    {


        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre
        ]);
    }
}
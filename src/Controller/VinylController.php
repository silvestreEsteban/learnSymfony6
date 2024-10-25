<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use function Symfony\Component\String\u;

class VinylController
{
    #[Route('/')]
    public function lola(): Response
    {
        return new Response('Homepage');
    }
    #[Route('browse/{slug}')]
    public function browse(string $slug = null): Response
    {
        if($slug){
            $title = 'Genre: '.u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title = 'All Genres';
        }

        return new Response($title);
    }
}
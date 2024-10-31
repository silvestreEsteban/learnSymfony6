<?php

namespace App\Controller;

use App\Entity\VinylMix;
use App\Repository\VinylMixRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MixController extends AbstractController
{
    #[Route('/mix/new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $mix = new VinylMix();
        $mix->setTitle('Raggamuffin Reloaded - SHY FX');
        $mix->setDescription('Absolute Banger');
        $genres = ['Pop', 'Rock'];
        $mix->setGenre($genres[array_rand($genres)]);
        $mix->setTrackCount(10);
        $mix->setVotes(rand(50, -50));

        $entityManager->persist($mix);
        $entityManager->flush();

        return new Response(sprintf(
            'Mix %d is %d tracks of pure D&B Madness',
            $mix->getId(),
            $mix->getTrackCount()
        ));
    }

    #[Route('/mix/{slug}', name: 'app_mix_show')]
    public function show(VinylMix $mix): Response
    {
        return $this->render('mix/show.html.twig', [
            'mix' => $mix
        ]);
    }

    #[Route('/mix/{id}/vote', name: 'app_mix_vote')]
    public function vote(VinylMix $mix, Request $request, EntityManagerInterface $entityManager): Response
    {
        $direction = $request->request->get('direction', 'up');
        if($direction === 'up') {
            $mix->upVote();
        } else {
            $mix->downVote();
        }
        $entityManager->flush();
        $this->addFlash('success', 'vote counted');

        return $this->redirectToRoute('app_mix_show', ['slug' => $mix->getSlug()]);

    }

}
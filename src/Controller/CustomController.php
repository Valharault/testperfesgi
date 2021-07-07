<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomController extends AbstractController
{
    #[Route('/custom', name: 'custom')]
    public function index(FilmRepository $filmRepository): Response
    {
        $output = $actors = $producers = [];
        $films = ($filmRepository->findBy([],null,100));
        foreach ($films as $film) {

            foreach ($film->getRoles() as $actorRole) {
                usleep(2000);
                $actors[] = [
                    'actor_name' => $actorRole->getActor()->getFullName(),
                    'character_name' => $actorRole->getCharacterName(),
                    'character_description' => $actorRole->getCharacterDescription(),
                    'role' => $actorRole->getRoleType()->getType(),

                ];
            }

            foreach ($film->getProducers() as $producer) {
                usleep(2000);
                $producers[] = [
                    'name' => $producer->getName(),
                    'email' => $producer->getEmail(),
                    'website' => $producer->getWebsite()
                ];
            }
            $output[] = [
                'id' => $film->getId(),
                'title' => $film->getTitle(),
                'duration' => $film->getDuration(),
                'genre' => $film->getGenre()->getName(),
                'story' => $film->getStory(),
                'roles' => $actors,
                'producers' => $producers
            ];
        }
        return $this->json($output, 200);
    }
}

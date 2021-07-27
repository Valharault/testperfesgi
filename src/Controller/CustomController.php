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
        // O(1)
        $output = $actors = $producers = [];
        // O(1)
        $films = ($filmRepository->findBy([],null,100));
        // O(n)
        foreach ($films as $film) {
            // O(n)
            foreach ($film->getRoles() as $actorRole) {
                usleep(2000);
                // O(1)
                $actors[] = [
                    'actor_name' => $actorRole->getActor()->getFullName(),
                    'character_name' => $actorRole->getCharacterName(),
                    'character_description' => $actorRole->getCharacterDescription(),
                    'role' => $actorRole->getRoleType()->getType(),

                ];
            }
            // O(n)
            foreach ($film->getProducers() as $producer) {
                usleep(2000);
                $producers[] = [
                    'name' => $producer->getName(),
                    'email' => $producer->getEmail(),
                    'website' => $producer->getWebsite()
                ];
            }
            // O(1)
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

        // ====> O(n) * (O(n) + O(n)) => O(n) * O(2n) négligeable = résultat O(n^2)
    }
}

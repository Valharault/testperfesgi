<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\ActorRole;
use App\Entity\Film;
use App\Entity\FilmGenres;
use App\Entity\Producer;
use App\Entity\RoleType;
use App\Repository\ActorRepository;
use App\Repository\FilmGenresRepository;
use App\Repository\FilmRepository;
use App\Repository\RoleTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppFixtures extends Fixture
{
    /** @var Faker\Factory $faker */
    private $faker;

    /** @var ActorRepository $actorRepository */
    private $actorRepository;

    /** @var RoleTypeRepository $roleTypeRepository */
    private $roleTypeRepository;

    /** @var FilmGenresRepository $filmGenresRepository */
    private $filmGenresRepository;

    /** @var FilmRepository $filmRepository */
    private $filmRepository;

    public function __construct(
        ActorRepository $actorRepository,
        RoleTypeRepository $roleTypeRepository,
        FilmGenresRepository $filmGenresRepository,
        FilmRepository $filmRepository
    ) {
        $this->actorRepository = $actorRepository;
        $this->roleTypeRepository = $roleTypeRepository;
        $this->filmGenresRepository = $filmGenresRepository;
        $this->filmRepository = $filmRepository;
        $this->faker = Faker\Factory::create('fr_FR');
    }


    public function load(ObjectManager $manager)
    {
        $this->createGenre($manager);
        $this->createProducer($manager);
        $this->createActor($manager);
        $this->createRoleType($manager);
        $this->createFilm($manager);
        $this->createActorRole($manager);
    }

    protected function createGenre($manager)
    {

        $genres = [
            "Americana (genre cinématographique)|Americana",
            "Art vidéo",
            "Buddy movie",
            "Chanbara",
            "Chronologie|Chronique",
            "Cinéma amateur",
            "Cinéma d'auteur",
            "Cinéma de montagne",
            "Cinéma expérimental",
            "Cinéma abstrait",
            "Cinéma structurel",
            "Cinéma underground",
            "Found footage",
            "Comédie",
            "Burlesque",
            "Comédie de mœurs",
            "Comédie dramatique",
            "Comédie policière",
            "Comédie romantique",
            "Parodie",
            "Screwball comedy",
            "Documentaire",
            "Cinéma ethnographique",
            "Cinéma d'observation",
            "Cinéma vérité",
            "Cinéma direct",
            "Docufiction",
            "Ethnofiction",
            "Essai cinématographique",
            "Film d'archives",
            "Journal filmé",
            "Portrait",
            "Cinéma surréaliste",
            "Drame (cinéma)|Drame",
            "Mélodrame (cinéma)|Mélodrame",
            "Docudrama",
            "Film à sketches",
            "Film à suspense",
            "Film d'action",
            "Film d'aventures",
            "Film de cape et d'épée",
            "Film catastrophe",
            "Film criminel",
            "Film policier",
            "Film de gangsters",
            "Film noir",
            "Thriller (cinéma)|Thriller",
            "Film de cambriolage",
            "Film érotique",
            "Film d'espionnage",
            "Film d'exploitation",
            "Film fantastique",
            "Film de vampire",
            "Film de zombies",
            "Film de monstres",
            "Film de guerre",
            "Cinéma de guérilla|Film de guérilla",
            "Film historique",
            "Film biographique",
            "Film autobiographique",
            "Film institutionnel",
            "Film de mariage",
            "Film publicitaire",
            "Film d'entreprise",
            "Film de propagande",
            "Film d'horreur",
            "Slasher",
            "Film de super-héros",
            "Film musical",
            "Film d'opéra",
            "Film pornographique",
            "Teen movie",
            "Chanbara|Ken Geki",
            "Masala (cinéma)|Masala",
            "Road movie",
            "Film d'amour",
            "Péplum",
            "Science-fiction",
            "Serial (cinéma)|Sérial",
            "Troma",
            "Western"
        ];
        foreach ($genres as $genre) {
            $genre = (new FilmGenres())
                ->setName($genre)
                ->setCreatedAt(new \DateTime());
            $manager->persist($genre);
        }
        $manager->flush();
    }

    protected function createProducer($manager) {
        for ($i = 0; $i < 5000; $i++) {
            $producer = (new Producer())
                ->setName($this->faker->firstName.' '.$this->faker->lastName)
                ->setEmail($this->faker->email)
                ->setWebsite($this->faker->url);
            $manager->persist($producer);
        }
        $manager->flush();
    }

    protected function createRoleType($manager) {
        for ($i = 0; $i < 100; $i++) {
            $roleType = (new RoleType())
                ->setCreatedAt(new \DateTime())
                ->setType('Acteur '. $i);
            $manager->persist($roleType);
        }
        $manager->flush();
    }

    protected function createActor($manager) {
        for ($i = 0; $i < 100000; $i++) {
            $actor = (new Actor())
                ->setFullName($this->faker->firstName.' '.$this->faker->lastName)
                ->setNotes($this->faker->text(200));
            $manager->persist($actor);
        }
        $manager->flush();
    }

    protected function createFilm($manager) {
        for ($i = 0; $i < 50000; $i++) {
            $film = (new Film())
                ->setCreatedAt(new \DateTime())
                ->setGenre($this->filmGenresRepository->find($this->faker->numberBetween(1,81)))
                ->setAdditionnalInformation($this->faker->text(200))
                ->setDuration($this->faker->numberBetween(90,150))
                ->setReleaseDate($this->faker->dateTimeThisYear)
                ->setStory($this->faker->text(2000))
                ->setTitle($this->faker->jobTitle);
            $manager->persist($film);
        }
        $manager->flush();
    }

    protected function createActorRole($manager) {
        $n = $this->faker->numberBetween(10,25);
        for ($i = 0; $i < $n; $i++) {
            $actorRole = (new ActorRole())
                ->setActor($this->actorRepository->find($this->faker->numberBetween(1,10000)))
                ->setCharacterDescription($this->faker->text(500))
                ->setCharacterName($this->faker->firstName.' '.$this->faker->lastName)
                ->setFilm($this->filmRepository->find($this->faker->numberBetween(1,50000)))
                ->setRoleType($this->roleTypeRepository->find($this->faker->numberBetween(1,100)));
            $manager->persist($actorRole);
        }
        $manager->flush();
    }

}




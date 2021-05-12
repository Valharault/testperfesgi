<?php

namespace App\Command;

use App\Entity\Actor;
use App\Entity\ActorRole;
use App\Entity\Film;
use App\Entity\FilmCertificate;
use App\Entity\FilmGenres;
use App\Entity\Producer;
use App\Entity\RoleType;
use App\Repository\ActorRepository;
use App\Repository\FilmCertificateRepository;
use App\Repository\FilmGenresRepository;
use App\Repository\FilmRepository;
use App\Repository\ProducerRepository;
use App\Repository\RoleTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Faker;

class CreateDataCommand extends Command
{
    protected static $defaultName = 'import:data';
    protected static $defaultDescription = 'Add a short description for your command';

    private $em;
    private $container;

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

    /** @var FilmCertificateRepository $filmCertificateRepository */
    private $filmCertificateRepository;

    /** @var ProducerRepository $producerRepository */
    private $producerRepository;

    public function __construct(
        ActorRepository $actorRepository,
        RoleTypeRepository $roleTypeRepository,
        FilmGenresRepository $filmGenresRepository,
        FilmRepository $filmRepository,
        EntityManagerInterface $em,
        ContainerInterface $container,
        FilmCertificateRepository $filmCertificateRepository,
        ProducerRepository $producerRepository
    ) {
        $this->actorRepository = $actorRepository;
        $this->roleTypeRepository = $roleTypeRepository;
        $this->filmGenresRepository = $filmGenresRepository;
        $this->filmRepository = $filmRepository;
        $this->filmCertificateRepository = $filmCertificateRepository;
        $this->producerRepository = $producerRepository;
        $this->faker = Faker\Factory::create('fr_FR');
        parent::__construct();
        $this->em = $em;
        $this->container = $container;
    }

    protected function configure()
    {
        $this->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);

        $io = new SymfonyStyle($input, $output);

        $this->createGenre($io);
        $this->createProducer($io);
        $this->createActor($io);
        $this->createRoleType($io);
        $this->createFilmCertificates($io);
        $this->createFilm($io);

        return 0;
    }

    protected function createGenre($io)
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
        $io->title('Start creating : FilmGenre');
        $io->progressStart(count($genres));
        foreach ($genres as $genre) {
            $genre = (new FilmGenres())
                ->setName($genre)
                ->setCreatedAt(new \DateTime());
            $this->em->persist($genre);
            $io->progressAdvance();
        }
        $io->block('');
        $io->success('Creation terminated');
        $io->progressFinish();
        $this->em->flush();
    }

    protected function createProducer($io) {
        $io->title('Start creating : Producers');
        $io->progressStart(5000);
        for ($i = 0; $i < 5000; $i++) {
            $producer = (new Producer())
                ->setName($this->faker->firstName.' '.$this->faker->lastName)
                ->setEmail($this->faker->email)
                ->setWebsite($this->faker->url);
            $this->em->persist($producer);
            $io->progressAdvance();
        }
        $io->block('');
        $io->success('Creation terminated');
        $io->progressFinish();
        $this->em->flush();
    }

    protected function createRoleType($io) {
        $io->title('Start creating : RoleType');
        $io->progressStart(100);
        for ($i = 0; $i < 100; $i++) {
            $roleType = (new RoleType())
                ->setCreatedAt(new \DateTime())
                ->setType('Acteur '. $i);
            $this->em->persist($roleType);
            $io->progressAdvance();
        }
        $io->block('');
        $io->success('Creation terminated');
        $io->progressFinish();
        $this->em->flush();
    }

    protected function createActor($io) {
        $io->title('Start creating : Actor');
        $io->progressStart(100000);
        for ($i = 0; $i < 100000; $i++) {
            $actor = (new Actor())
                ->setFullName($this->faker->firstName.' '.$this->faker->lastName)
                ->setNotes($this->faker->text(200));
            $this->em->persist($actor);
            $io->progressAdvance();
        }
        $io->block('');
        $io->success('Creation terminated');
        $io->progressFinish();
        $this->em->flush();
    }

    protected function createFilmCertificates($io) {
        $io->title('Start creating : Certificates');
        $io->progressStart(200);
        for ($i = 0; $i < 200; $i++) {
            $filmCertificate = (new FilmCertificate())
                ->setName($this->faker->text)
                ->setCreatedAt(new \DateTime());
            $this->em->persist($filmCertificate);
            $io->progressAdvance();
        }
        $io->block('');
        $io->success('Creation terminated');
        $io->progressFinish();
        $this->em->flush();
    }

    protected function createFilm($io) {
        $io->title('Start creating : Film');
        $io->progressStart(50000);
        for ($i = 0; $i < 50000; $i++) {
            $film = (new Film())
                ->setCreatedAt(new \DateTime())
                ->setGenre($this->filmGenresRepository->find($this->faker->numberBetween(1,81)))
                ->setAdditionnalInformation($this->faker->text(200))
                ->setDuration($this->faker->numberBetween(90,150))
                ->setReleaseDate($this->faker->dateTimeThisYear)
                ->setStory($this->faker->text(2000))
                ->setCertificates($this->filmCertificateRepository->find($this->faker->numberBetween(1,200)))
                ->setTitle($this->faker->jobTitle);
            $n = $this->faker->numberBetween(2,5);
            for ($p = 0; $p < $n; $p++) {
                $film->addProducer($this->producerRepository->find($this->faker->numberBetween(1,5000)));
            }
            $this->em->persist($film);
            $this->createActorRole($film);
            $io->progressAdvance();
        }
        $io->block('');
        $io->success('Creation terminated');
        $io->progressFinish();
        $this->em->flush();
    }

    protected function createActorRole($film) {
        $n = $this->faker->numberBetween(2,5);
        for ($i = 0; $i < $n; $i++) {
            $actorRole = (new ActorRole())
                ->setActor($this->actorRepository->find($this->faker->numberBetween(1,10000)))
                ->setCharacterDescription($this->faker->text(500))
                ->setCharacterName($this->faker->firstName.' '.$this->faker->lastName)
                ->setFilm($film)
                ->setRoleType($this->roleTypeRepository->find($this->faker->numberBetween(1,100)));
            $this->em->persist($actorRole);
        }
    }

}

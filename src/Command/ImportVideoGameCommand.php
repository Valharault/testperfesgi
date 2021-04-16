<?php

namespace App\Command;

use App\Entity\VideoGame;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ImportVideoGameCommand extends Command
{
    protected static $defaultName = 'import:video_game';
    protected static $defaultDescription = 'Add a short description for your command';

    private $em;
    private $container;

    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        parent::__construct();
        $this->em = $em;
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('En attente de la lecture du CSV Video Games');
        $reader = Reader::createFromPath('%kernel.root_dir%/../src/data/video_games.csv');
        $videoGames = $reader->fetch();

        $io->progressStart(iterator_count($videoGames));
        foreach ($videoGames as $videoGame) {
            $newVideoGame = (new VideoGame())
                ->setName($videoGame[0])
                ->setPlatform($videoGame[1])
                ->setYear((int)$videoGame[2])
                ->setCreatedAt(new \DateTime())
                ->setUpdateAt(null)
                ->setType($videoGame[3])
                ->setDeveloper($videoGame[14])
                ->setRating($videoGame[15])
                ->setPublisher($videoGame[4]);
            $this->em->persist($newVideoGame);
            $this->em->flush();
            $io->progressAdvance();
        }

        $io->success('Import des videogames terminés');
        $io->progressFinish();
        return 0;
    }
}

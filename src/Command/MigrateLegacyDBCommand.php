<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\News;
use App\Entity\Tournament;
use App\Entity\TournamentResult;
use DateTime;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MigrateLegacyDBCommand extends Command
{
    private const LEGACY_RESULT_CATEGORIES = ['wyniki', 'protokoly', 'historie', 'pdf'];
    private const RESULT_URL_PREFIX = 'https://slzbs.pl/protokoly';

    protected static $defaultName = 'migrate:legacyDB';

    private ContainerInterface $container;
    private Connection $connLegacy;
    private EntityManagerInterface $em;

    public function __construct(
        ContainerInterface $container,
        EntityManagerInterface $em,
        string $name = null
    ) {
        parent::__construct($name);
        $this->container = $container;
        $this->connLegacy = $this->container->get('doctrine')->getConnection('mysqlLegacy');
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setDescription('Migrate data from the legacy database')
            ->addArgument('table', InputArgument::REQUIRED, 'which table to migrate')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $tableName = $input->getArgument('table');

        if ($tableName) {
            switch ($tableName) {
                case 'news':
                    $this->migrateNews($io);
                    break;
                case 'results':
                    $this->migrateResults($io);
                    break;
            }
        }

        return 0;
    }

    private function migrateNews(SymfonyStyle $io): void
    {
        $query = $this->queryLegacyNews();
        $io->progressStart($query->rowCount());
        foreach ($query->fetchAllAssociative() as $data) {
            $news = $this->createEntityNews($data);
            $this->em->persist($news);
            $io->progressAdvance();
        }
        $this->em->flush();
        $io->success('News migrated!');
    }

    private function migrateResults(SymfonyStyle $io): void
    {
        $query = $this->queryLegacyResults();
        $io->progressStart($query->rowCount());
        foreach ($query->fetchAllAssociative() as $data) {
            $io->progressAdvance();
            if ($data['date'] === '0000-00-00') {
                $io->writeln(' [WARNING] id: ' . $data['id'] . ' - date 0000-00-00');
                continue;
            }
            $tournament = $this->createEntityTournament($data);
            $this->em->persist($tournament);
            $this->updateTournamentResults($tournament, $data);
            try {
                $this->em->flush();
            } catch (\Throwable $e) {
                $io->error($e->getMessage());
                $io->error($data);
            }
        }
        $this->em->flush();
        $io->success('Results migrated!');
    }

    private function concatenate(string $title, string $text1, string $text2): string
    {
        return
            (empty($title) ? '' : $title . '<br>')
            . (empty($text1) ? '' : $text1 . '<br>')
            . (empty($text2) ? '' : $text2);
    }

    private function createEntityNews(array $data): News
    {
        $news = new News(
            $this->concatenate($data['title'], $data['text1'], $data['text2']),
            true
        );

        $news->setDate(DateTime::createFromFormat('Y-m-d H:i:s', $data['date']));
        return $news;
    }

    private function queryLegacyNews(): Statement
    {
        $query = $this->connLegacy->prepare('select * from `news` where `show` = 1');
        $query->execute();
        return $query;
    }

    private function queryLegacyResults(): Statement
    {
        $query = $this->connLegacy->prepare('select * from `turnieje` where `show` = 1');
        $query->execute();
        return $query;
    }

    private function createEntityTournament(array $data): Tournament
    {
        $tournament = new Tournament();
        $tournament->setName($data['miasto']);
        $tournament->setDescription($data['nazwa']);
        $tournament->setDate(DateTime::createFromFormat('Y-m-d', $data['date']));
        $tournament->setPublished(true);
        return $tournament;
    }

    private function updateTournamentResults(Tournament $tournament, array $data): void
    {
        foreach (self::LEGACY_RESULT_CATEGORIES as $name) {
            if (empty($data[$name]) === false) {
                $link = substr($data[$name], 0, 1) === '/'
                    ? self::RESULT_URL_PREFIX . $data[$name]
                    : self::RESULT_URL_PREFIX . '/' . $data[$name];

                $tournamentResult = new TournamentResult();
                $tournamentResult->setName($name);
                $tournamentResult->setLink($link);
                $tournamentResult->setPublished(true);
                $this->em->persist($tournamentResult);

                $tournament->addResult($tournamentResult);
                $this->em->persist($tournament);
            }
        }
    }
}

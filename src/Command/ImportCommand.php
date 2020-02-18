<?php

namespace App\Command;

use App\Service\FeedsImporter;
use App\Service\FeedsImporterFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCommand extends Command
{

    /**
     * @var FeedsImporter
     */
    private $importer;

    protected static $defaultName = 'app:import';


    public function __construct(string $name = null, FeedsImporter $feedsImporter)
    {
        $this->importer = $feedsImporter;
        parent::__construct($name);
    }


    protected function configure(): void
    {
        $this
            ->setDescription('Import all configured feeds to the database')
            ->addArgument(
                'id',
                InputArgument::OPTIONAL,
                'set ID of feed if you need to import only one'
            )
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $feedId = $input->getArgument('id');

        if ($feedId) {
            $io->note(\sprintf('You passed not implemented argument: %s', $feedId));
        }
        else {
            $this->importer->import();
        }
        $io->success('Import script is executed! Pass --help to see your options.');

        return 0;
    }


}

<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCommand extends Command
{

    protected static $defaultName = 'app:import';


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
            $io->note(\sprintf('You passed an argument: %s', $feedId));
        }
        else {
            //call importFactory here with all feedClasses injected
            ;
        }
        $io->success('Import script is executed! Pass --help to see your options.');

        return 0;
    }


}

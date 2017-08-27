<?php
/**
 * Created by Rida Amirini.
 * Initial version by: ridaamirini
 * Initial version created on: 26.08.17 - 15:33
 */

namespace App\Command;


use App\Utils\Version;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommandVersion extends Command
{
    protected function configure()
    {
       $this->setName('version')
            ->setAliases(['v'])
            ->setDescription('Current Version of PHPQueryBuilder');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln((new Version())->getVersion());
    }
}
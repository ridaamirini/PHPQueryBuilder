<?php
/**
 * Created by RidaSmart Apps UG (haftungsbeschränkt).
 * Initial version by: ridaamirini
 * Initial version created on: 26.08.17 - 16:22
 */

namespace App\Command;



use App\Schema\ConfigFile;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommandInit extends Command
{
    protected function configure()
    {
        $this->setName('init')
            ->setDescription('Initializes a new project');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = getcwd();
        $output->writeln(getcwd());
        $config = new ConfigFile();

        if (!is_writable($path)) return $output->writeln('<errorr>Permission denied to write phpqb.json!!!</errorr>');
        if ($config->save($path) === FALSE)  return $output->writeln('<errorr>Cannot write phpqb.json!!!</errorr>');

        $output->writeln('phpqb.json successfully created.');
        return false;
    }
}
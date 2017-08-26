<?php
/**
 * Created by RidaSmart Apps UG (haftungsbeschränkt).
 * Initial version by: ridaamirini
 * Initial version created on: 26.08.17 - 15:33
 */

namespace App\Command;


use App\Schema\QueryCollection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CommandDump extends Command
{
    protected function configure()
    {
       $this->setName('dump')
            ->setAliases(['d'])
            ->setDefinition(new InputDefinition([
                new InputOption('collection', 'c', InputOption::VALUE_REQUIRED),
                new InputOption('filename', 'f', InputOption::VALUE_OPTIONAL),
            ]))
            ->setDescription('Converts QueryCollection to SQL Syntax/Dump');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $collection = $input->getOption('collection');
        $filename = $input->getOption('filename');

        if (empty($collection)) return $output->writeln('<error>No Collection is given!!!</error>');

        $content = $this->getContent($collection);

        if (!$content) throw new \InvalidArgumentException('collection must be an instance of QueryCollection');

        if (!empty($filename)) {
            $content->dump($filename);
            return false;
        }

        $output->writeln($content->parse());

        return false;
    }

    private function getContent($include)
    {
        $content = include_once($include);

        if (!($content instanceof QueryCollection)) return false;

        return $content;
    }
}
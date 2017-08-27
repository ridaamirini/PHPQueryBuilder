<?php
/**
 * Created by Rida Amirini.
 * Initial version by: ridaamirini
 * Initial version created on: 26.08.17 - 16:22
 */

namespace App\Command;



use App\Schema\ConfigFile;
use App\Schema\Exclude;
use App\Schema\Files;
use App\Schema\Folder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

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
        $config = new ConfigFile();

        if (file_exists($path . '/phpqb.json')) {
            $helper = $this->getHelper('question');
            $question = new ConfirmationQuestion('Do you want to override phpqb.json? <info>[y/j = yes]</info>:', false, '/^(y|j)/i');

            if (!$helper->ask($input, $output, $question)) {
                $output->writeln('Aborted');
                return false;
            }
        }

        $config->setFolder([
            (new Folder())->toArray(),
        ]);
        $config->setFiles([
            (new Files())->toArray()
        ]);
        $config->setExcludes([
            (new Exclude())->toArray()
        ]);


        if (!is_writable($path)) return $output->writeln('<errorr>Permission denied to write phpqb.json!!!</errorr>');
        if ($config->save($path) === FALSE)  return $output->writeln('<errorr>Cannot write phpqb.json!!!</errorr>');

        $output->writeln('phpqb.json successfully created.');
        return false;
    }
}
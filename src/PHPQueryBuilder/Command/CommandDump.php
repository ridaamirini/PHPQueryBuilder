<?php
/**
 * Created by Rida Amirini.
 * Initial version by: ridaamirini
 * Initial version created on: 26.08.17 - 15:33
 */

namespace App\Command;


use App\Exception\NoAccessException;
use App\Schema\ConfigFile;
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
                new InputOption('filename', 'f', InputOption::VALUE_REQUIRED),
                new InputOption('config', 'conf', InputOption::VALUE_NONE),
            ]))
            ->setDescription('Converts QueryCollection to SQL Syntax/Dump');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $collection = $input->getOption('collection');
        $filename = $input->getOption('filename');

        $config_opt = $input->hasParameterOption('--config');
        $config_opt_short = $input->hasParameterOption('-conf');

        if (empty($collection) && empty($filename) || $config_opt || $config_opt_short) {
            $this->runWithConfig($output);
            return false;
        }

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
        if (!file_exists($include)) throw new NoAccessException();

        $content = include_once($include);

        if (!($content instanceof QueryCollection)) return false;

        return $content;
    }

    private function runWithConfig($output)
    {
        $filename = getcwd() . '/phpqb.json';

        if (!file_exists($filename)) return $output->writeln('<error>No phpqb.json in current dirctory. Please initialize PHPQueryBuilder.</error>');

        $config = json_decode(file_get_contents($filename), true);
        $config = new ConfigFile($config);
        $excludes = $config->getExcludes();
        $default = $config->getDefaultDestination();

        if (!is_dir($default) && !empty($default)) return $output->writeln('<error>Default destination must be a directory!!!</error>');

        //Folder
        if (!empty($config->getFolder())) {
            $output->writeln([
                '',
                '<info>Folder</info>',
                '<info>==========================</info>',
                '',
            ]);

            foreach ($config->getFolder() as $folder) {
                if (!is_dir($folder->getFrom()) || $this->isExcluded($folder->getFrom(), $excludes)) {
                    $output->writeln([
                        '<bg=yellow;options=bold;fg=black>    Skipped: ' . $folder->getFrom() . '     </>',
                        ''
                    ]);
                    continue;
                }

                $files = glob($folder->getFrom() . '/*.php');

                foreach ($files as $file) {
                    if ($this->isExcluded($file, $excludes)) {
                        $output->writeln([
                            'Excluded: ' . $file,
                            ''
                        ]);
                        continue;
                    }

                    $dest = $this->dump($file, $folder->getTo(), $default);

                    if ($dest) {
                        $output->writeln([
                                'Successfully created: ' . $dest,
                                '',
                        ]);
                    }
                }
            }

            $output->writeln([
                '<info>==========================</info>',
                '<info>Folder FINISH</info>',
                '',
            ]);
        }

        //Files
        if (!empty($config->getFiles())) {
            $output->writeln([
                '',
                '<info>Files</info>',
                '<info>==========================</info>',
                '',
            ]);

            foreach ($config->getFiles() as $file) {
                if (!file_exists($file->getFrom()) || !is_dir($file->getTo()) || $this->isExcluded($file->getFrom(), $excludes)) {
                    $output->writeln([
                        '<bg=yellow;options=bold;fg=black>    Skipped: ' . $file->getFrom() . '     </>',
                        ''
                    ]);
                    continue;
                }

                $dest = $this->dump($file->getFrom(), $file->getTo(), $default);

                if ($dest) {
                    $output->writeln([
                        'Successfully created: ' . $dest,
                        '',
                    ]);
                }
            }

            $output->writeln([
                '<info>==========================</info>',
                '<info>Files FINISH</info>',
                '',
            ]);
        }

        return false;
    }

    private function dump($from, $to, $default)
    {
        $content = $this->getContent($from);

        if (!$content) throw new \InvalidArgumentException('collection must be an instance of QueryCollection');

        $filename = pathinfo($from)['filename'];

        if (empty($to)) {
            if (empty($default)) throw new \InvalidArgumentException('Default Destination must be set!!!');

            $to = $default;
        }
        if (is_dir($to)) $to = $to . '/' . $filename . '.sql';

        $content->dump($to);

        return $to;
    }

    private function isExcluded($paths, $exclude)
    {
        for ($i = 0; $i < count($exclude); $i++) $exclude[$i] = $exclude[$i]->getPath();

        if (is_array($paths)) {
            foreach ($paths as $path) {
                if (in_array($path, $exclude)) return true;
            }
        }

        if (in_array($paths, $exclude)) return true;

        return false;
    }
}
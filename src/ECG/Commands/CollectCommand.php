<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.12.2015
 * Time: 13:55
 */

namespace ECG\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CollectCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('collect:data')
            ->setDescription('Collecting HW and SW data for the report ')
            ->addArgument(
                'role',
                InputArgument::REQUIRED,
                'Set server role type for collecting data'
            )
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will yell in uppercase letters'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $role = $input->getArgument('role');
        if ($role) {
            $text = 'Role: '.$role;
        }

        if ($input->getOption('yell')) {
            $text = strtoupper($role);
        }

        $output->writeln($text);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: dgergun
 * Date: 29.12.15
 * Time: 18:20
 */

namespace ECG\Reports;

use ECG\Infos\OSInfo;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OSReport {

    public function PrepareReport(InputInterface $input, OutputInterface $output){

        $os_info = new OSInfo();
        $platform = $os_info->getPlatform();
        $release = $os_info->getRelease();
        $kernel = $os_info->getKernel();
        $arch = $os_info->getArchitecture();
        $hostname = $os_info->getHostName();

        $output->writeln('');$output->writeln('');
        $output->writeln('OS Parameters Table:');

        $table = new Table($output);
        $table->addRow(['Platform', $platform]);
        $table->addRow(['Release', $release]);
        $table->addRow(['Architecture', $arch]);
        $table->addRow(['Kernel', $kernel]);
        $table->addRow(['Hostname', $hostname]);

        $table->render();
    }

}
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
        $kernel = $os_info->getKernel();
        $hostname = $os_info->getHostName();

        $output->writeln('');$output->writeln('');
        $output->writeln('Table:');

        $table = new Table($output);
        $table->setHeaders(array(
            array(new TableCell('OS parameters'),array('colspan' => 3))
        ));
        $table->addRow([sprintf('Kernel version: <info>%s</info>',$kernel)]);
        $table->addRow([sprintf('Hostname: <info>%s</info>',$hostname)]);

        $table->render();
    }

}
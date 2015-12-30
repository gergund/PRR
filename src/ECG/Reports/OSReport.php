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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OSReport {

    public function PrepareReport(InputInterface $input, OutputInterface $output){

        $os_info = new OSInfo();
        $kernel = $os_info->getKernel();
        $hostname = $os_info->getHostName();
        $info = 'Linux version: '.$kernel.' Hostname: '.$hostname;
        $text = "Application execution statement: ".$info;
        $output->writeln($text);

        $output->writeln('');$output->writeln('');
        $output->writeln('Table:');

        $rows = 10;
        $table = new Table($output);
        for ($i = 0; $i<$rows; $i++) {
            $table->addRow([
                sprintf('Row <info># %s</info>', $i),
                rand(0, 1000)
            ]);

        }
        $table->render();
    }

}
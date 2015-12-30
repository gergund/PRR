<?php
/**
 * Created by PhpStorm.
 * User: dgergun
 * Date: 29.12.15
 * Time: 16:13
 */
namespace ECG\Infos;

class OSInfo {

    public function getPlatform(){

        $file = '/proc/version';

        if (!is_file($file) || !is_readable($file)) {
            return 'Unknown';
        }

        $contents = file_get_contents($file);
        if (preg_match('/Linux/', $contents, $match) != 1   ) {
            return 'Unknown';
        }

        return $match[1];
    }

    public function getKernel(){

        $file = '/proc/version';

        if (!is_file($file) || !is_readable($file)) {
            return 'Unknown';
        }

        $contents = file_get_contents($file);
        if (preg_match('/^Linux version (\S+).+$/', $contents, $match) != 1) {
            return 'Unknown';
        }

        return $match[1];
    }

    public function getHostName()
    {
        $file = '/proc/sys/kernel/hostname';
        $hostname = file_get_contents($file);

        if ($hostname === false) {
            return 'Unknown';
        }

        return $hostname;
    }



}
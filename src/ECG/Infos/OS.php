<?php
/**
 * Created by PhpStorm.
 * User: dgergun
 * Date: 29.12.15
 * Time: 16:13
 */
namespace ECG\Infos;

class OS {

    public function getKernel(){

        $file = '/proc/version';

        if (!is_file($file) || !is_readable($file)) {
            //Errors::add('Linfo Core', '/proc/version not found');
            return 'Unknown';
        }

        $contents = file_get_contents($file);
        // Parse it
        if (preg_match('/^Linux version (\S+).+$/', $contents, $match) != 1) {
            //Errors::add('Linfo Core', 'Error parsing /proc/version');
            return 'Unknown';
        }
        // Return it
        return $match[1];
    }
}
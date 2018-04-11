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
        return $match[0];
    }

    public function getRelease() {

        $file_system = '/etc/system-release';
        $file = '/etc/issue.net';

        if (is_file($file_system) || is_readable($file_system)) {
            $release = trim(file_get_contents($file_system));

            return $release;
        }
        elseif (!is_file($file) || !is_readable($file)) {
            return 'Unknown';
        }

        $release = trim(file_get_contents($file));

        if ($release === false) {
            return 'Unknown';
        }

        return $release;
    }

    public function getArchitecture() {

        $file = '/proc/version';

        if (!is_file($file) || !is_readable($file)) {
            return 'Unknown';
        }

        $contents = file_get_contents($file);
        if (preg_match('/(amd64|x86_64)/', $contents, $match) != 1) {
            return 'Unknown';
        }

        if ($match[0] == 'amd64' || $match[0] == 'x86_64') {
            $os_arch = 'OS = 64-bit';
        }
        else {
            $os_arch = 'OS = Unknown';
        }

        $file = '/proc/cpuinfo';

        if (!is_file($file) || !is_readable($file)) {
            return 'Unknown';
        }

        $contents = file_get_contents($file);
        if (preg_match('/lm/', $contents, $match) != 1) {
            return 'Unknown';
        }

        if ($match[0] == 'lm'){
            $hw_arch = 'CPU = 64-bit';
        }
        else {
            $hw_arch = 'CPU = Unknown';
        }

        return $hw_arch.', '.$os_arch;

    }

    public function getThreading(){

        $contents=shell_exec('getconf -a | grep GNU_LIBPTHREAD_VERSION 2>&1');
        $contents=trim($contents);

        if (preg_match('/GNU_LIBPTHREAD_VERSION             (\S+ *.*)/', $contents, $match) != 1) {
            return 'Unknown';
        }

        return $match[1];
    }

    public function getCompiler(){

        $contents=shell_exec('gcc -v 2>&1');

        $contents=trim($contents);

        if (preg_match('/gcc version (.*)/', $contents, $match) != 1) {
            return 'Unknown';
        }

        return $match[0];
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
        $hostname = trim(file_get_contents($file));

        if ($hostname === false) {
            return 'Unknown';
        }

        return $hostname;
    }

    public function getSElinux()
    {
        $contents=shell_exec('getenforce 2>&1');
        $contents = trim($contents);

        if (preg_match('/(Enforcing|Permissive|Disabled)/', $contents, $match) != 1) {
            return 'No SELinux detected';
        }

        return $match[0];
    }

    public function command_exists($cmd)
    {
        $return = shell_exec(sprintf("which %s", escapeshellarg($cmd)));
        return !empty($return);
    }

    public function getVirtualized()
    {

        if ( $this->command_exists('lspci') ) {

            $contents=shell_exec('lspci 2>&1');
            $contents = trim($contents);

            if (preg_match('/(virtualbox|xen|vmware|kvm)/i', $contents, $match) != 1) {
                return 'No Virtualization detected';
            }

            return $match[0];
        }
        elseif ( $this->command_exists('hostnamectl')) {

            $contents=shell_exec('hostnamectl 2>&1 | grep Virtualization');
            $contents = trim($contents);

            if (preg_match('/Virtualization: (\S+)/', $contents, $match) != 1) {
                return 'No Virtualization detected';
            }

            return $match[1];

        }
        else {
            return 'No Virtualization detected';
        }

    }

}
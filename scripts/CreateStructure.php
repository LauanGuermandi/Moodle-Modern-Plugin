<?php

namespace Modern\Scripts;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class CreateStructure
{
    /**
     * @param $path
     */
    private static function create_dir($path){
        $path = __DIR__ . $path;

        if(!file_exists($path)){
            mkdir($path);
        }
    }

    /**
     * @param PackageEvent $event
     */
    public static function postPackageInstall(PackageEvent $event)
    {
        $dirs = [
            './../../pages',
            './../../views',
            './../../traits',
            './../../classes',
        ];

        foreach ($dirs as $dir) {
            self::create_dir($dir);
        }

    }
}

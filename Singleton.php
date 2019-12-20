<?php
/**
 * Created by PhpStorm.
 * User: bagau
 * Date: 20.12.2019
 * Time: 3:17
 */

class Singleton
{
    private static $object;

    private function __construct()
    {

    }

    public static function getSingleton()
    {
        if (!self::$object)
            self::$object = new Singleton();

        return self::$object;
    }

    public function echoTest()
    {
        echo 'test';
    }
}

$singleton = Singleton::getSingleton();

$singleton->echoTest();

$secondSingleton = Singleton::getSingleton();

$secondSingleton->echoTest();

if ($singleton === $secondSingleton)
    echo 'equal';
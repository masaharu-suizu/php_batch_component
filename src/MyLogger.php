<?php

namespace App;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\Yaml\Yaml;

class MyLogger
{
    /**
     * @return Logger
     */
    public static function logger(): Logger
    {
        $configuration = Yaml::parseFile(__DIR__.'/../config/app.yaml');
        $name = $configuration['logger']['name'];
        $level = $configuration['logger']['level'];

        $logger = new Logger($name);
        $logger->pushHandler(new StreamHandler(__DIR__.'/../var/log/app.log', $level));

        return $logger;
    }
}
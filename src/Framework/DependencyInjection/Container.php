<?php

namespace App\Framework\DependencyInjection;

class Container
{
    private static $instance;

    public static function getInstance()
    {
        if (! static::$instance) {
            static::$instance = require __DIR__ . '/config.php';
        }

        return static::$instance;
    }
}
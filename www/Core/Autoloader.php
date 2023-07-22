<?php

namespace App\Core;

/*
Autoloader(): Classe contenant l'autoloader qui est instancié dans index.php
*/
class Autoloader
{
    public static function run()
    {
        spl_autoload_register(function ($class) {
            $class = str_replace("App\\", "", $class);
            $class = str_replace("\\", "/", $class) . ".php";
            if (file_exists($class)) {
                include $class;
            }
        });
    }
}
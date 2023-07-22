<?php

namespace App;
use App\Core\Router;
use App\Core\Autoloader;
session_start();
require_once "Core/Autoloader.php";

Autoloader::run();

Router::run();


// var_dump($_SESSION['pseudo']);
// var_dump($_SESSION['email']);
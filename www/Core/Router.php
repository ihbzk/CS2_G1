<?php

namespace App\Core;
use App\Models\User;

// use currentUser;

class Router {
    public static function run() {
        // Charger les routes à partir du fichier YAML
        $routes = self::loadRoutes();

        // Récupérer l'URI de la requête
        $uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
        $uri = rtrim(strtolower(trim($uriExploded[0])), "/");
        $uri = (empty($uri)) ? "/" : $uri;

        // Vérifier si la route existe dans le fichier de routes
        if (empty($routes[$uri])) {
            http_response_code(404);
            echo $uri;
            die("Page 404");
        }

        // Récupérer le contrôleur et l'action de la route
        $controller = $routes[$uri]["controller"];
        $action = $routes[$uri]["action"];
        $security = $routes[$uri]["security"];
        $role = $routes[$uri]["role"];

        // Vérification de l'existence de la classe du contrôleur
        $controllerClass = "\\App\\Controllers\\" . $controller;
        if (!class_exists($controllerClass)) {
            die("La classe " . $controllerClass . " n'existe pas");
        }

        // Vérifier si la variable APP_NAME est définie dans .env
        // $envFile = __DIR__ . '/../.env';
        // $envVars = parse_ini_file($envFile);
        // if (empty($envVars['APP_NAME'])) {
        //     if($action != 'install')
        //     {
        //         header('location: /install/step-1');
        //     }
        // }

        // Instancier le contrôleur et appeler l'action
            $controllerInstance = new $controllerClass();

        // Vérification de l'existence de la méthode d'action
        if (!method_exists($controllerInstance, $action)) {
            die("La méthode " . $action . " n'existe pas");
        }
        
        // var_dump($_SESSION);
        if($security === true){
            if(in_array($_SESSION['role'], $role)){
                $controllerInstance->$action();
            } else {
                // THROW A 404;
                // RESPONSE CODE + REDIRECT + EXIT;
                
                http_response_code(404);
                //header('Location: ../Views/error404.php');
                exit;
            }
        } else {
            $controllerInstance->$action();
        }
    }

    private static function loadRoutes() {
        $routesFile = "routes.yml";
        if (!file_exists($routesFile)) {
            die("Le fichier de routing n'existe pas");
        }
        return yaml_parse_file($routesFile);
    }
}
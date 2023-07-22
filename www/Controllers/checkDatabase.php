<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Sql;
use App\Core\Verificator;

class CheckDatabase extends Sql
{
    public function check()
    {
        // Récupérer les données envoyées depuis la requête
        $databaseName = $_POST['databaseName'];
        $databaseUsername = $_POST['databaseUsername'];
        $databasePassword = $_POST['databasePassword'];
        $port = $_POST['databasePort'];
        $host = $_POST['databaseHost'];
        // Autres données de configuration de la base de données...

        // Vérifier les informations de configuration de la base de données
        // Effectuer les opérations nécessaires pour configurer la base de données

        // Exemple de réponse JSON pour indiquer si la configuration a réussi ou non
        /* if (!empty($databaseName) && !empty($databaseUsername) && !empty($databasePassword)) {
            $response = array('success' => true);
        } else {
            $response = array('success' => false, 'message' => 'Informations de configuration de la base de données manquantes');
        } */

        // Envoyer la réponse JSON
        header('Content-Type: application/json');
        try {
            $pdo = new \PDO("pgsql:host=$host;port=$port;dbname=$databaseName", $databaseUsername, $databasePassword);
            // Connexion réussie, tout est OK
            $response = array('success' => true);
            echo(json_encode($response));
        } catch (\PDOException $e) {
            // La connexion a échoué, renvoyer un message d'erreur
            $e = $e. "";
            $response = array('success' => false, 'message' => 'Informations de configuration de la base de données incorrectes.');
            echo(json_encode($response));
        }
    }
}
/* class CheckDatabase extends Sql
{
    public function check()
    {
        // Récupérer les données envoyées depuis la requête POST
        $databaseName = $_POST['databaseName'];
        $databaseUsername = $_POST['databaseUsername'];
        $databasePassword = $_POST['databasePassword'];
        // Autres données de configuration de la base de données...

        // Récupérer les données du fichier .env
        $env = __DIR__ . '/../.env';
        $envVar = parse_ini_file($env);

        $envDatabaseName = $envVar['DB_NAME'];
        $envDatabaseUsername = $envVar['DB_USERNAME'];
        $envDatabasePassword = $envVar['DB_PASSWORD'];
        // Vérifier si les informations fournies correspondent à celles du fichier .env
        if ($databaseName === $envDatabaseName &&
            $databaseUsername === $envDatabaseUsername &&
            $databasePassword === $envDatabasePassword) {
            // Connexion réussie, tout est OK
            $response = array('success' => true);
            echo(json_encode($response));
        } else {
            // La connexion a échoué, renvoyer un message d'erreur
            $response = array('success' => false, 'message' => 'Informations de configuration de la base de données incorrectes.');
            echo(json_encode($response));
        }
    }
}
 */
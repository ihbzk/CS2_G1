<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Sql;
use App\Core\Verificator;
use App\Models\User;

class createUser extends Sql
{
    public function create()
    {
        // Récupérer les données envoyées depuis la requête
        $appName = $_POST['appName'];
        $email = $_POST['email'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];

        $verificator = new Verificator();
        if ($verificator::formInstaller(array('appName' => $appName, 'email' => $email, 'lastname' => $lastname, 'firstname' => $firstname, 'password' => $password, 'passwordConfirm' => $passwordConfirm)) == "") {
            $admin = User::getInstance();
            $admin->setIdRole(2);
            $admin->setFirstname($firstname);
            $admin->setLastname($lastname);
            $admin->setPseudo('Admin 1');
            $admin->setEmail($email);
            $admin->setPassword($password);
            $admin->setBirthDate('01/01/1999');
            $admin->setIsVerified(true);
            // ... Ajoutez d'autres attributs et configurez l'administrateur selon vos besoins ...

            // On insère l'administrateur en base de données
            $admin->save();

            //On set le nom du site dans notre fichier .env
            // Enregistrement de $appName dans le fichier .env
            $envFilePath = __DIR__ . '/../.env';
            $envContents = file_get_contents($envFilePath);

            // Assurez-vous que la variable $appName est définie et non vide avant de l'ajouter au fichier .env

            $appName = trim($appName);
            $newEnvLine = "\nAPP_NAME={$appName}";
            $envContents .= $newEnvLine;

            // Écriture de la nouvelle valeur d'APP_NAME dans le fichier .env
            file_put_contents($envFilePath, $envContents);

            // Vous pouvez également définir la valeur dans la variable d'environnement $_ENV pour qu'elle soit accessible dans le script en cours
            $_ENV['APP_NAME'] = $appName; 


            $response = array('success' => true);
            echo (json_encode($response));
        } else {
            $response = array('success' => false, 'message' => 'Informations de configuration de la base de données incorrectes.');
            echo (json_encode($response));
        }
    }
}
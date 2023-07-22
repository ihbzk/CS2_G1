<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Sql;

class User extends Sql
{

    /*
    User(): Fonction qui permet d'afficher l'utilisateur connecté (à renommer et à déplacer)
    */
    public function userProfile()
    {
        if (isset($_SESSION['email'])) {
            $view = new View("Users/profil", "front");

            $email = $_SESSION['email'];
            $userData = $this->getUserByEmail($email);

            if (isset($_POST['deleteUser'])) {
                $deleteUser = $this->deleteUser($_POST['id']);
            } else {
                $deleteUser = null;
            }

            $view->assign('userData', $userData);
            $view->assign('deleteUser', $deleteUser);
        } else {
            echo "Non connecté.";
        }
    }

    public function updateUserField($fieldName)
    {
        if (isset($_POST[$fieldName])) {
            $newFieldValue = $_POST[$fieldName];
            $currentUser = $this->getUserByEmail($_SESSION['email']);
            $currentUser[$fieldName] = $newFieldValue;

            $updateMethod = 'updateUser' . ucfirst($fieldName);
            $this->$updateMethod($currentUser);

            header("Location: /profile");
            exit;
        }
    }

    public function updateFirstname()
    {
        $this->updateUserField('firstname');
    }

    public function updateLastname()
    {
        $this->updateUserField('lastname');
    }

    public function updatePseudo()
    {
        $this->updateUserField('pseudo');
    }

    public function updatePhone()
    {
        $this->updateUserField('phone');
    }

    public function updateAddress()
    {
        $this->updateUserField('address');
    }

    public function updateThumbnail()
    {
        $this->updateUserField('thumbnail');
    }
}

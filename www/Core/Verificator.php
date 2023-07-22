<?php

namespace App\Core;

use App\Controllers\Security;
use App\Core\Sql;

/*
Verificator(): Classe qui permet de filtrer les données fournies par l'utilisateur afin de nettoyer les données
               entrées en base de données
*/

class Verificator extends Sql
{
    public static function form(array $config, array $data): string
    {
        $listOfErrors = [];
        $pwd = "";
        $pwdConfirm = "";

        foreach ($config["inputs"] as $name => $input) {
            if ($input["type"] == "email" && !self::checkEmail($data[$name])) {
                array_push($listOfErrors, $input['error']);
            } elseif ($input['type'] == 'date' && self::checkBirthDate($data[$name]) != "") {
                array_push($listOfErrors, self::checkBirthDate($data[$name]));
            } elseif ($input['type'] == 'number' && $name == "phone" && self::checkPhoneNumber($data[$name]) != "") {
                array_push($listOfErrors, self::checkPhoneNumber($data[$name]));
            } elseif ($input['type'] == 'number' && $name == "zip_code" && self::checkZipcode($data[$name]) != "") {
                array_push($listOfErrors, self::checkZipcode($data[$name]));
            } elseif ($input['type'] == 'text' && ($name == "firstname" || $name == "lastname") && self::checkNames($data[$name], $name) != "") {
                array_push($listOfErrors, self::checkNames($data[$name], $name));
            } elseif (empty($data[$name])) {
                if ($name == 'country') {
                    array_push($listOfErrors, "Veuillez choisir un pays.");
                } elseif ($name == 'pseudo') {
                    array_push($listOfErrors, "Veuillez rentrer un pseudo.");
                }
            } elseif ($name == 'pseudo') {
                if (preg_match("/\\s/", $data[$name])) {
                    array_push($listOfErrors, "Les espaces ne sont pas acceptés dans le pseudo.");
                }
            } elseif ($input['type'] == 'password' && $name == "pwd") {
                $pwd = $data[$name];
                echo $pwd;
            } elseif ($input['type'] == 'password' && $name == "pwdConfirm") {
                $pwdConfirm = $data[$name];
                echo $pwdConfirm;
            } elseif ($pwd != "" && $pwdConfirm != "") {
                echo "mdp remplis";
                if (self::checkPassword($pwd, $pwdConfirm) != "") {
                    array_push($listOfErrors, self::checkPassword($pwd, $pwdConfirm));
                    $pwd = "";
                    $pwdConfirm = "";
                }
            }
        }
        if ($pwd != "" && $pwdConfirm != "") {
            if (self::checkPassword($pwd, $pwdConfirm) != "") {
                array_push($listOfErrors, self::checkPassword($pwd, $pwdConfirm));
            }
        } else {
            array_push($listOfErrors, "Veuillez inscrire un mot de passe et le confirmer.");
        }

        $errorString = "";
        foreach ($listOfErrors as $error) {
            $errorString = $errorString . "<br>" . $error;
        }
        return $errorString;
    }

    /*
    CheckEmail(): Fonction qui permet de vérifier la validité d'un email d'un point de vue syntaxique
    */
    public static function checkEmail($email): mixed
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function checkBirthDate($birthdate): String
    {
        $error = "";
        if (empty($birthdate)) {
            $error = "Veuillez rentrer une date de naissance.";
        } elseif (!is_string($birthdate) || $birthdate == 'yyyy-mm-dd') {
            $error = "Veuillez rentrer une date de naissance valide.";
        } elseif (!preg_match('~^([0-9]{4})-([0-9]{2})-([0-9]{2})$~', $birthdate, $parts)) {
            # Check the format
            $error = "Votre date n'est pas au bon format.";
        }
        $d = strtotime($birthdate);
        if (time() - $d < 568024668) {
            $error = "Vous devez être majeur pour souscrire au service.";
        }
        return $error;
    }

    public static function checkPhoneNumber($phone): String
    {
        $error = "";
        if (preg_match('/^[0-9]{10}+$/', $phone)) {
        } else {
            $error =  "Veuillez rentrer un numéro de téléphone valide.";
        }
        return $error;
    }

    public static function checkZipcode($zipcode): String
    {
        $error = "";
        if (strlen($zipcode) < 5) {
            $error = "Veuillez rentrer un format de code postale valide.";
        }
        return $error;
    }

    public function checkUpdateProduct(array $data): array
    {
        $errors = [];
        $_SESSION['key'] = "";
        foreach ($data as $key => $field) {
            if ($key == 'name') {
                //check sur le champ name
                $checkName = $this->checkExistingProduct($field);
                if ($checkName) {
                    array_push($errors, "Nom de produit déjà existant");
                }
            } elseif ($key == 'price') {
                if ($field <= 0) {
                    array_push($errors, "Veuillez inscrire un prix positif pour le produit.");
                }
            } elseif ($key == 'description') {
            }
        }
        return $errors;
    }

    public function checkUpdatePage(array $data): array
    {
        $errors = [];
        $_SESSION['key'] = "";
        foreach ($data as $key => $field) {
            if ($key == 'slug') {
                //check sur le champ name
                $checkName = $this->checkExistingPage($field);
                if ($checkName) {
                    array_push($errors, "URL de page déjà existant");
                }
            }
        }
        return $errors;
    }

    public static function checkNames(String $insertedName, String $input): String
    {
        $error = "";
        if ($input == 'firstname') {
            if (empty($insertedName)) {
                $error = "Veuillez rentrer un prénom.";
            } else {
                if (preg_match('~[0-9]+~', $insertedName))
                    $error = "Veuillez rentrer un prénom valide.";
            }
        } elseif ($input == 'lastname') {
            if (empty($insertedName)) {
                $error = "Veuillez rentrer un nom.";
            } else {
                if (preg_match('~[0-9]+~', $insertedName))
                    $error = "Veuillez rentrer un nom valide.";
            }
        }
        return $error;
    }

    public static function verifToken($code, $tokenInserted): bool
    {
        $userCode = substr($tokenInserted, 0, 6);
        if ($userCode == $code) {
            return true;
        }
        $_SESSION['verifCodeError'] = "Le code de vérification est erroné.";
        return false;
    }

    public function verifLogin(array $config, array $data): string
    {
        $listOfErrors = [];
        $email = "";
        $pwd = "";
        $security = new Security();
        foreach ($config["inputs"] as $name => $input) {
            if (empty($data[$name])) {
                $listOfErrors = [];
                array_push($listOfErrors, "Veuillez remplir tous les champs.");
                break;
            }
            if ($input["type"] == "email") {
                if (!self::checkEmail($data[$name])) {
                    array_push($listOfErrors, $input['error']);
                } else {
                    $email = $data[$name];
                    if (!$this->emailExists(strtolower(trim($email)))) {
                        array_push($listOfErrors, "La combinaison mot de passe email est erronné.");
                        break;
                    }
                }
            } elseif ($input["type"] == "password") {
                $pwd = $data[$name];
                $dataUser = $this->getPasswordAndRoleByEmail($email);
                $hashedPassword = $dataUser['pwd'];
                if (!$hashedPassword || !password_verify($pwd, $hashedPassword)) {
                    array_push($listOfErrors, "La combinaison mot de passe email est erronné.");
                    break;
                }
            }
        }
        if (empty($listOfErrors)) {
            if ($this->getIsVerifiedByEmail($email) != 1) {
                array_push($listOfErrors, "Votre compte n'est pas vérifié. Un email de confirmation vient de vous être envoyé.");
                $user = $this->getUserByEmail($email);
                $security->sendEmailToRegistered($user, $user['id_role'], "verif");
            }
        }

        $errorString = "";
        foreach ($listOfErrors as $error) {
            $errorString = $errorString . "<br>" . $error;
        }
        return $errorString;
    }

    public function checkEmailForSendPassword(array $config, array $data): string
    {
        $listOfErrors = [];
        $email = "";
        $security = new Security();
        foreach ($config["inputs"] as $name => $input) {
            if ($input["type"] == "email") {
                if (!self::checkEmail($data[$name])) {
                    array_push($listOfErrors, $input['error']);
                } else {
                    $email = $data[$name];
                    if (!Sql::emailExists(strtolower(trim($email)))) {
                        array_push($listOfErrors, "L'utilisateur avec l'email rentré n'existe pas.");
                        break;
                    }
                }
            }
        }
        $errorString = "";
        foreach ($listOfErrors as $error) {
            $errorString = $errorString . "<br>" . $error;
        }
        return $errorString;
    }

    public static function checkPassword(String $pwd, String $pwdConfirm): String
    {
        $error = "";
        if ($pwd == "" || $pwdConfirm == "") {
            $error = "Entrer un mot de passe valide et veuillez le confirmer.";
        } elseif ($pwd != $pwdConfirm) {
            $error = "Les deux mots de passe ne correspondent pas";
        } elseif (!preg_match('@[A-Z]@', $pwd) || !preg_match('@[a-z]@', $pwd) || !preg_match('@[0-9]@', $pwd) || strlen($pwd) < 8) {
            $error = "Votre mot de passe doit au minimum faire 8 caractères et doit au moins contenir : <ul><li>Une minuscule</li><li>Une majuscule</li><li>Un chiffre compris entre 0 et 9</li></ul>";
        }

        return $error;
    }

    public static function formInstaller( array $data): string
    {
        $listOfErrors = [];
    
        // Vérification de l'email en utilisant la fonction checkEmail de Verificator
        if (empty($data['email']) || !self::checkEmail($data['email'])) {
            array_push($listOfErrors, "Veuillez renseigner une adresse email valide.");
        }
    
        // Vérification du prénom en utilisant la fonction checkNames de Verificator
        if (empty($data['firstname']) || self::checkNames($data['firstname'], 'firstname') !== "") {
            array_push($listOfErrors, "Veuillez renseigner un prénom valide.");
        }
    
        // Vérification du nom de famille en utilisant la fonction checkNames de Verificator
        if (empty($data['lastname']) || self::checkNames($data['lastname'], 'lastname') !== "") {
            array_push($listOfErrors, "Veuillez renseigner un nom de famille valide.");
        }
    
        // Vérification du mot de passe et confirmation du mot de passe
        $pwd = $data['password'];
        $pwdConfirm = $data['passwordConfirm'];
        if (empty($pwd) || empty($pwdConfirm)) {
            array_push($listOfErrors, "Veuillez remplir le mot de passe et la confirmation du mot de passe.");
        } elseif ($pwd !== $pwdConfirm) {
            array_push($listOfErrors, "Les deux mots de passe ne correspondent pas.");
        } elseif (self::checkPassword($pwd, $pwdConfirm) !== "") {
            array_push($listOfErrors, self::checkPassword($pwd, $pwdConfirm));
        }
    
        // ... Ajoutez d'autres vérifications spécifiques si nécessaire ...
    
        $errorString = "";
        foreach ($listOfErrors as $error) {
            $errorString = $errorString . "<br>" . $error;
        }
        return $errorString;
    }
}

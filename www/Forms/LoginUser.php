<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\User;

class LoginUser extends AForm
{
    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Se connecter",
                "cancel" => "Retour à l'accueil",
                "location" => ""
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Entrez un email",
                    "label" => "Email",
                    "error" => "Les informations fournies sont incorrectes.",
                    "same" => "no",
                    "value" => ""
                ],
                "pwd" => [
                    "type" => "password",
                    "placeholder" => "Entrez votre mot de passe",
                    "label" => "Mot de passe",
                    "same" => "no",
                    "value" => ""
                ]
            ]
        ];
    }
}

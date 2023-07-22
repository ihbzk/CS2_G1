<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\Seller;

class SendPassword extends AForm
{
    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Confirmer",
                "cancel" => "Annuler",
                "location" => "login"
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Entrez votre email",
                    "label" => "Email",
                    "error" => "Adresse e-mail invalide.",
                    "same" => "no",
                    "value" => ""
                ],
            ]
        ];
    }
}

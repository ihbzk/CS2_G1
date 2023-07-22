<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\Seller;

class DefinePassword extends AForm
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
                "location" => ""
            ],
            "inputs" => [
                "pwd" => [
                    "type" => "password",
                    "placeholder" => "Entrez un nouveau mot de passe",
                    "label" => "Nouveau mot de passe",
                    "error" => "Aucun mot de passe fourni.",
                    "same" => "no",
                    "value" => ""
                ],
                "confirmPwd" => [
                    "type" => "password",
                    "placeholder" => "Confirmez le nouveau mot de passe",
                    "label" => "Confirmation du nouveau mot de passe",
                    "error" => "Aucun mot de passe de confirmation fourni.",
                    "same" => "no",
                    "value" => ""
                ],
            ]
        ];
    }
}

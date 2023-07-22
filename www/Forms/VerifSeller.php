<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\Seller;

class VerifSeller extends AForm
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
                "cancel" => "Annuler"
            ],
            "inputs" => [
                "code" => [
                    "type" => "text",
                    "placeholder" => "Entrez le code de vérification",
                    "label" => "Code de vérification",
                    "error" => "Le code de vérification est incorrect.",
                    "same" => "no",
                ],
            ]
        ];
    }
}

<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\Product;
use App\Models\Category;
use App\Controllers\Seller;


class AddComment extends AForm
{
    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Ajouter un commentaire",
                "cancel" => "Annuler",
                "value" => "",
                "location" => "products/page?id=" . $_GET['id']
            ],
            "inputs" => [
                "comment" => [
                    "type" => "text",
                    "placeholder" => "Entrez votre commentaire",
                    "label" => "Commentaire",
                    "error" => "Le format de votre commentaire est incorrect.",
                    "same" => "no",
                    "value" => ""
                ]
            ]
        ];
    }
}

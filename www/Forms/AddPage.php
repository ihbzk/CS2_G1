<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;

class AddPage extends AForm
{
    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Ajouter une page",
                "cancel" => "Annuler",
                "location" => "admin/pages",
            ],
            "inputs" => [
                "cover_image" => [
                    "type" => "text",
                    "placeholder" => "Choisissez une image de couverture pour votre page",
                    "label" => "Image de couverture",
                    // "min" => 2,
                    // "max" => 60,
                    "error" => "Le format de l'image de couverture n'est pas correcte.",
                    "same" => "no",
                    "value" => ""
                ],
                "cover_title" => [
                    "type" => "text",
                    "placeholder" => "Entrez un titre de couverture pour votre page",
                    "label" => "Titre de couverture de la page",
                    // "min" => 2,
                    // "max" => 60,
                    "error" => "Le titre de couverture de la page n'est pas correcte.",
                    "same" => "no",
                    "value" => ""
                ],
                "slug" => [
                    "type" => "text",
                    "placeholder" => "Entrez une URL personnalisée (Slug)",
                    "label" => "URL personnalisée",
                    // "min" => 2,
                    // "max" => 90,
                    "error" => "L'URL doit faire entre 2 et 90 caractères.",
                    "same" => "yes",
                    "value" => ""
                ],
                "meta_title" => [
                    "type" => "text",
                    "placeholder" => "Entrez un titre (Meta title)",
                    "label" => "Titre",
                    "min" => 2,
                    "max" => 90,
                    "error" => "Le titre doit faire entre 2 et 90 caractères.",
                    "same" => "yes",
                    "value" => ""
                ],
                "meta_description" => [
                    "type" => "text",
                    "placeholder" => "Entrez une description (Meta description)",
                    "label" => "Description",
                    "min" => 2,
                    "max" => 200,
                    "error" => "Le titre doit faire entre 2 et 200 caractères.",
                    "same" => "yes",
                    "value" => ""
                ],
                "meta_keywords" => [
                    "type" => "text",
                    "placeholder" => "Entrez un mot clé (Meta keywords)",
                    "label" => "Mot clé",
                    // "min" => 2,
                    // "max" => 90,
                    "error" => "Le titre doit faire entre 2 et 90 caractères.",
                    "same" => "yes",
                    "value" => ""
                ]
            ]
        ];
    }
}

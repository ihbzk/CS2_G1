<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\Page;

class EditPage extends AForm
{
    protected $method = "POST";

    public function getConfig(): array
    {

        // $pageModel = new Page();
        $pageModel = Page::getInstance();
        $pageData = $pageModel->getPageById($_GET['id']);

        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "/update-page-name",
                "enctype" => "",
                "submit" => "Modifier une page",
                "cancel" => "Annuler",
                "location" => "admin/pages"
            ],
            "inputs" => [
                "cover_image" => [
                    "type" => "file",
                    "placeholder" => "Entrez une URL pour votre image de couverture",
                    "label" => "URL de l'image de couverture",
                    // "min" => 2,
                    // "max" => 60,
                    "error" => "L'URL de l'image de couverture n'est pas correcte.",
                    "same" => "no",
                    "value" => $pageData['cover_image']
                ],
                "cover_title" => [
                    "type" => "text",
                    "placeholder" => "Entrez un titre de couverture pour votre page",
                    "label" => "Titre de couverture de la page",
                    // "min" => 2,
                    // "max" => 60,
                    "error" => "Le titre de couverture de la page n'est pas correcte.",
                    "same" => "no",
                    "value" => $pageData['cover_title']
                ],
                "slug" => [
                    "type" => "text",
                    "placeholder" => "Entrez une URL de page",
                    "label" => "URL de la page",
                    // "min" => 2,
                    // "max" => 60,
                    "error" => "L'URL de la page n'est pas correcte.",
                    "same" => "yes",
                    "value" => $pageData['slug']
                ],
                "meta_title" => [
                    "type" => "text",
                    "placeholder" => "Entrez une meta title",
                    "label" => "Meta Title",
                    "min" => 50,
                    "max" => 100,
                    "error" => "La meta title doit faire entre 50 et 100 caractères.",
                    "same" => "yes",
                    "value" => $pageData['meta_title']
                ],
                "meta_description" => [
                    "type" => "text",
                    "placeholder" => "Entrez une meta description",
                    "label" => "Meta Description",
                    "min" => 100,
                    "max" => 200,
                    "error" => "La meta description doit faire entre 100 et 200 caractères.",
                    "same" => "yes",
                    "value" => $pageData['meta_description']
                ],
                "meta_keywords" => [
                    "type" => "text",
                    "placeholder" => "Entrez une meta keywords",
                    "label" => "Meta Keywords",
                    // "min" => 100,
                    // "max" => 200,
                    "error" => "La meta keywords doit faire entre 100 et 200 caractères.",
                    "same" => "yes",
                    "value" => $pageData['meta_keywords']
                ]
            ]
        ];
    }
}

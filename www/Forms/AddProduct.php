<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\Product;
use App\Models\Category;

class AddProduct extends AForm
{
    protected $method = "POST";

    public function getConfig(): array
    {
        // $category_model = new Category();
        $category_model = Category::getInstance();
        $categories = $category_model->getAllCategory();

        $options_category = [];
        foreach ($categories as $category) {
            $options_category[$category['id']] = $category['name'];
        }

        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Ajouter un produit",
                "cancel" => "Annuler",
                "location" => "products/all"
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "placeholder" => "Entrez un nom de produit",
                    "label" => "Nom",
                    "min" => 2,
                    "max" => 60,
                    "error" => "Le nom du produit doit faire entre 2 et 60 caractères.",
                    "same" => "no",
                    "value" => ""
                ],
                "description" => [
                    "type" => "text",
                    "placeholder" => "Entrez une description",
                    "label" => "Description",
                    "min" => 10,
                    "max" => 500,
                    "error" => "La description doit faire entre 10 et 500 caractères.",
                    "same" => "no",
                    "value" => ""
                ],
                "price" => [
                    "type" => "number",
                    "placeholder" => "Entrez le prix",
                    "label" => "Prix",
                    "min" => 0,
                    "error" => "Le prix doit être un nombre positif.",
                    "same" => "yes",
                    "value" => ""
                ],
                "id_category" => [
                    "type" => "select",
                    "pre-select" => "--- Choisir une catégorie de produits ---",
                    "label" => "Catégorie",
                    "options" => $options_category,
                    "error" => "La catégorie sélectionnée est incorrecte.",
                    "same" => "yes",
                    "value" => ""
                ],
                "stock" => [
                    "type" => "select",
                    "pre-select" => "--- Choisir une quantité de stock ---",
                    "label" => "Stock",
                    "options" => ["0", "1", "∞"],
                    "error" => "Le stock sélectionné est incorrect.",
                    "same" => "yes",
                    "value" => ""
                ],
                "max_quantity" => [
                    "type" => "number",
                    "placeholder" => "Entrez la quantité maximale",
                    "label" => "Quantité maximale",
                    "min" => 0,
                    "error" => "La quantité maxiamle doit être un nombre positif.",
                    "same" => "yes",
                    "value" => ""
                ],
                "thumbnail" => [
                    "type" => "text",
                    "label" => "Photo de présentation",
                    "error" => "Une erreur est survenue avec la valeur thumnbail",
                    "placeholder" => "Entrez le chemin de la photo de présentation du profil",
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

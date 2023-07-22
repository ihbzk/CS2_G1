<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\Product;
use App\Models\Category;

class EditProduct extends AForm
{
    protected $method = "POST";

    public function getConfig(): array
    {
        // $category_model = new Category();
        $category_model = Category::getInstance();
        $categories = $category_model->getAllCategory();

        // $productModel = new Product();
        $productModel = Product::getInstance();
        $productData = $productModel->getProductById($_GET['id']);

        $options_category = [];
        $categoryName = "";
        $categoryId = "";

        foreach ($categories as $category) {
            $options_category[$category['id']] = $category['name'];
            if ($productData['id_category'] == $category['id']) {
                $categoryName = $category['name'];
                $categoryId = $category['id'];
            }
        }

        // var_dump($productData['name']);

        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "/update-product-name",
                "enctype" => "",
                "submit" => "Modifier un produit",
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
                    "value" => $productData['name']
                ],
                "description" => [
                    "type" => "text",
                    "placeholder" => "Entrez une description",
                    "label" => "Description",
                    "min" => 10,
                    "max" => 500,
                    "error" => "La description doit faire entre 10 et 500 caractères.",
                    "same" => "no",
                    "value" => $productData['description']
                ],
                "price" => [
                    "type" => "number",
                    "placeholder" => "Entrez le prix",
                    "label" => "Prix",
                    "min" => 0,
                    "error" => "Le prix doit être un nombre positif.",
                    "same" => "yes",
                    "value" => $productData['price']
                ],
                "category" => [
                    "type" => "select",
                    "pre-select" => $categoryName,
                    "label" => "Catégorie",
                    "options" => $options_category,
                    "error" => "La catégorie sélectionnée est incorrecte.",
                    "same" => "yes",
                    "value" => $categoryId
                ],
                "stock" => [
                    "type" => "select",
                    "pre-select" => $productData['stock'],
                    "label" => "Stock",
                    "options" => ["0", "1", "∞"],
                    "error" => "Le stock sélectionné est incorrect.",
                    "same" => "yes",
                    "value" => $productData['stock']
                ],
                "max_quantity" => [
                    "type" => "number",
                    "placeholder" => "Entrez la quantité maximale",
                    "label" => "Quantité maximale",
                    "min" => 0,
                    "error" => "La quantité maxiamle doit être un nombre positif.",
                    "same" => "yes",
                    "value" => $productData['max_quantity']
                ],
                "thumbnail" => [
                    "type" => "text",
                    "label" => "Photo de présentation",
                    "error" => "Une erreur est survenue avec la valeur thumnbail",
                    "placeholder" => "Entrez le chemin de la photo de présentation du profil",
                    "same" => "no",
                    "value" => $productData['thumbnail']
                ]
            ]
        ];
    }
}

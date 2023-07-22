<?php

namespace App\Forms;

use App\Forms\Abstract\AForm;
use App\Models\User;

class AddUser extends AForm
{
    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "S'inscrire",
                "cancel" => "Retour à l'accueil",
                "location" => ""
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Entrez un prénom",
                    "label" => "Prénom",
                    "min" => 2,
                    "max" => 60,
                    "error" => "Votre prénom doit faire entre 2 et 60 caractères.",
                    "same" => "yes",
                    "value" => ""
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Entrez un nom",
                    "label" => "Nom",
                    "min" => 2,
                    "max" => 120,
                    "error" => "Votre nom doit faire entre 2 et 120 caractères.",
                    "same" => "yes",
                    "value" => ""
                ],
                "pseudo" => [
                    "type" => "text",
                    "placeholder" => "Entrez un nom d'utilisateur",
                    "label" => "Nom d'utilisateur",
                    "min" => 2,
                    "max" => 16,
                    "error" => "Votre nom d'utilisateur doit faire entre 2 et 16 caractères.",
                    "same" => "no",
                    "value" => ""
                ],
                "email" => [
                    "type" => "email",
                    "placeholder" => "Entrez un email",
                    "label" => "Email",
                    "error" => "Le format de votre email est incorrect.",
                    "same" => "no",
                    "value" => ""
                ],
                "pwd" => [
                    "type" => "password",
                    "placeholder" => "Entrez un mot de passe",
                    "label" => "Mot de passe",
                    "error" => "Votre mot de passe est incorrect.",
                    "same" => "yes",
                    "value" => ""
                ],
                "pwdConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmez votre mot de passe",
                    "label" => "Confirmation de mot de passe",
                    "confirm" => "pwd",
                    "error" => "Mot de passe de confirmation incorrect.",
                    "same" => "yes",
                    "value" => ""
                ],
                "phone" => [
                    "type" => "number",
                    "label" => "Numéro de téléphone",
                    "placeholder" => "Votre numéro de téléphone",
                    "error" => "Le format de votre téléphone est incorrect",
                    "same" => "no",
                    "value" => ""
                ],
                "birth_date" => [
                    "type" => "date",
                    "label" => "Date de naissance",
                    "placeholder" => "Votre date de naissance",
                    "error" => "Le format de votre date de naissance est incorrect",
                    "same" => "no",
                    "value" => ""
                ],
                "address" => [
                    "type" => "text",
                    "label" => "Adresse postale",
                    "placeholder" => "Votre adresse",
                    "min" => 2,
                    "max" => 256,
                    "same" => "no",
                    "value" => ""
                ],
                "zip_code" => [
                    "type" => "number",
                    "label" => "Code postal",
                    "placeholder" => "Votre code postal",
                    "min" => 2,
                    "max" => 5,
                    "same" => "yes",
                    "value" => ""
                ],
                "country" => [
                    "type" => "select",
                    "pre-select" => "--- Choisissez un pays ---",
                    "label" => "Pays",
                    "options" => ["FR", "US", "EN", "MOR", "ALG", "TUN", "CAM", "SEN"],
                    "error" => "Le pays selectionné est incorrect.",
                    "same" => "yes",
                    "value" => ""
                ],
                "thumbnail" => [
                    "type" => "text",
                    "label" => "Photo de profil",
                    "error" => "Une erreur est survenue avec la valeur thumnbail",
                    "placeholder" => "Entrez le chemin de la photo de profil",
                    "same" => "no",
                    "value" => ""
                ],
                "role" => [
                    "type" => "checkbox",
                    "label" => "Profil vendeur",
                    "placeholder" => "Cocher la case si vous souhaitez devenir un vendeur",
                    "value" => "on",
                    "same" => "no",
                    "value" => ""
                ]
            ]
        ];
    }
}

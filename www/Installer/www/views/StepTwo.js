// Importation des dépendances nécessaires
import FormComponent from "../components/FormComponent.js";
import InputComponent from "../components/Input.js";
import LinkComponent from "../components/Link.js";

// La classe StepTwo est dérivée de la classe FormComponent
export default class StepTwo extends FormComponent {
    constructor() {
        super({
            title: "Étape 2 : Informations du site",
            description: "Pour faire fonctionner le site, les informations ci-dessous sont requises.",
            inputs: [
                createInput("Nom du site", "Entrez le nom du site", "appName"),
                createInput("Prénom", "Entrez un prénom", "firstname"),
                createInput("Nom", "Entrez un nom", "lastname"),
                createInput("Adresse email", "Entrez l'adresse email", "email", "email"),
                createInput("Mot de passe", "Entrez un mot de passe", "password", "password"),
                createInput("Confirmation du mot de passe", "Confirmez votre mot de passe", "passwordConfirm", "password"),
            ],
            backLink: {
                class: "shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 mr-2 rounded-full cursor-pointer",
                title: "Étape précédente",
                link: "/install/step-1",
            },
            nextLink: new LinkComponent({
                class: "shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded-full cursor-pointer",
                title: "Me connecter",
                link: "/login",
                click: {
                    handler: (event) => handleNextClick(event)
                }
            })
        });
    }
}

// Fonction utilitaire pour créer une instance de la classe Input avec les paramètres spécifiés
function createInput(label, placeholder, name, type = "text") {
    return new InputComponent({
        label: label,
        classLabel: "mt-5 ml-4 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2",
        type: type,
        name: name,
        placeholder: placeholder,
        required: true,
        classInput: "border rounded-full appearance-none block w-full bg-white text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-3",
    }, true);
}

// Fonction de gestion du clic sur le lien "Étape suivante"
function handleNextClick(event) {
    event.preventDefault();

    const inputsObject = {};
    document.querySelectorAll(".form-container--content input").forEach(input => {
        // Récupère les valeurs des champs de saisie et les stocke dans un objet
        inputsObject[input.name] = input.value;
    });

    const placeholder = document.getElementById("error-message");
    placeholder.innerHTML = "Initialisation de l'application en cours.";

    // Envoie une requête POST à l'API pour configurer la base de données
    fetch("/api/user", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams(inputsObject).toString()

    }).then(response => response.json()).then(data => {
        console.log(data);
        if (!data.success) {
            // Affiche un message d'erreur si la configuration de la base de données échoue
            placeholder.innerHTML = data.message;
        } else {
            // Redirige vers la page de confirmation si la configuration de la base de données réussit
            window.location.href = "/login";
        }
    });
}

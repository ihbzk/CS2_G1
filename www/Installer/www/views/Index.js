// Importation des dépendances nécessaires
import InputComponent from "../components/Input.js";
import FormComponent from "../components/FormComponent.js";
import LinkComponent from "../components/Link.js";

// La classe Index est dérivée de la classe FormComponent
export default class Index extends FormComponent {
    constructor() {
        super({
            // Appelle le constructeur de la classe FormComponent avec les paramètres spécifiés
            title: "Installation de HipShop.",
            description: "Cette installation va vous permettre de configurer les étapes nécessaires pour installer HipShop.",

            // Création d'instances de la classe Input pour chaque champ de saisie requis
            inputs: [
                createInput("Hôte", "Saisissez l'hôte de la base de données", "databaseHost"),
                createInput("Port", "Saisissez le port de la base de données", "databasePort"),
                createInput("Nom de la base de données", "Saisissez le nom de la base de données", "databaseName"),
                createInput("Nom d'utilisateur", "Saisissez le nom d'utilisateur de la base de données", "databaseUsername"),
                createInput("Mot de passe", "Saisissez le mot de passe de la base de données", "databasePassword", "password"),
            ],

            // Définit le lien "Étape suivante" pour passer à l'étape suivante
            nextLink: new LinkComponent({
                class: "shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded-full cursor-pointer",
                title: "Étape 2",
                link: "/install/step-2",
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
    placeholder.innerHTML = "Connexion et initialisation de la base de données en cours.";

    // Envoie une requête POST à l'API pour configurer la base de données
    fetch("/api/database", {
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
            history.pushState({}, undefined, "/install/step-2");
        }
    })
}

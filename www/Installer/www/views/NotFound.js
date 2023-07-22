import FormComponent from "../components/FormComponent.js";

export default class NotFound extends FormComponent {
    constructor() {
        super({
            title: "Erreur 404",
            description: "La page que vous cherchez n'est pas accessible :/",
            nextLink: {
                class: "flex items-center justify-center w-full px-6 py-3 mb-3 text-lg text-white bg-red-700 rounded-md sm:mb-0 hover:bg-red-800 sm:w-auto",
                title: "Installation de HipShop",
                link: "/install",
            }
        });
    }
}

import Component from "./Component.js";
import Link from "./Link.js";

export default class FormComponent extends Component {
    constructor(props) {
        super(props);
        this.title = props.title ?? "Formulaire";
        this.description = props.description ?? "Description";
        this.inputs = props.inputs ?? [];
        this.actionDescription = props.actionDescription ?? "";
        this.backLink = props.backLink ?? null;
        this.nextLink = props.nextLink ?? null;
    }

    render() {
        const makeLink = (link) => link ? new Link({
            class: link.class,
            title: link.title,
            link: link.link,
            click: {
                handler: (event) => {
                    event.preventDefault();
                    history.pushState({}, undefined, link.link);
                }
            }
        }).render() : "";

        return {
            type: "div",
            children: [{
                type: "div",
                children: [
                    {
                        type: "div",
                        children: [
                            { type: "h1", children: [this.title], attributes: { class: "text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black py-8" } },
                            { type: "p", children: [this.description], attributes: { class: "text-justify pb-8" } },
                            { type: "div", children: [...this.inputs.map(input => input.render())], attributes: { class: "flex flex-wrap -mx-3 mb-6 form-container--content" } },
                        ],
                        attributes: { class: "flex justify-center items-center flex-col" }
                    },
                    { type: "p", children: [this.actionDescription], attributes: { id: "action-description" } },
                    { type: "p", children: [], attributes: { id: "error-message" } },
                    {
                        type: "div",
                        children: [ makeLink(this.backLink), this.nextLink instanceof Component ? this.nextLink.render() : makeLink(this.nextLink) ],
                        attributes: { class: "w-full px-3 pt-6 mb-6 md:mb-0 flex w-full justify-center items-center" }
                    },
                ],
                attributes: { class: "flex-column form-container" }
            }],
            attributes: { id: "page-container" }
        }
    }
}

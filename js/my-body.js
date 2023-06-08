/* Se importan los estilos y se le pasan a la variable styles */
import styles from "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" assert { type: "css" };

/* Se define la clase "myBody" que se extiende de HTMLElement (Web Component) */
export class myBody extends HTMLElement{

    /* Se llam al constructor de la clase padre utilizando "super()"  */
    constructor(){
        super();
        /* Se añaden los estilos importados */
        document.adoptedStyleSheets.push(styles);
    }

    /* Función que solicita el contenido del archivo "my-body.html" y devuelve en texo */
    async components(){
        return await (await fetch("view/my-body.html")).text();
    }

    /* Función "add" para añadir un web component para los articulos */
    async add(e){
        /* Hace referencia al elemento especifico al que se hizo click */
        let $ = e.target;
        /* función que verifica si el nombre del nodo al que se le hizo click es igual a "BUTTON" */
        if ($.nodeName == "BUTTON") {
            let plantilla = this.querySelector("#products").children;
            plantilla = plantilla[plantilla.length-1];
            plantilla = plantilla.cloneNode(true);
            document.querySelector("#products").insertAdjacentElement("beforeend", plantilla);
        }
    }

    /* "connectedCallback()"" es un método de ciclo del web component */
    connectedCallback(){
        /* Invoca la función this.components(), que obtiene HTML  Y devuelve una promesa*/
        this.components().then(html=>{
            /* Al cumplirse la promesa el contenido HTML recibido se le asigna a innerHTML  */
            this.innerHTML = html;
            this.add = this.querySelector("#add").addEventListener("click", this.add.bind(this));
         
        })
    }
}

/*  Se utiliza customElements.define() para registrar el elemento personalizado en el DOM con el nombre "my-body" y la clase myBody*/
customElements.define('my-body',myBody);
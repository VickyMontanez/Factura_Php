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

    /* Función "selection" para sumar o quitar cantidad del amount */
    selection(e){
        /* Hace referencia al elemento especifico al que se hizo click */
        let $ = e.target;

        /* nodeName = Devuelve el nombre del nodo en string */
        /* función que verifica si el nombre del nodo al que se le hizo click es igual a "BUTTON" */
        if($.nodeName == "BUTTON"){

            /* Variable selecciona solo a los inputs que sean dataset.row*/
            let inputs = document.querySelectorAll(`#${$.dataset.row} input`);
            /* Función que se asegura si es igual a "-" */
            if($.innerHTML == "-"){
                /* entonces recorra todos los inputs*/
                inputs.forEach(element => {
                    /* si el input "amount", su valor es 0, remueva el dataset*/
                   if(element.name == "amount" && element.value==0){
                        document.querySelector(`#${$.dataset.row}`).remove();
                    /* o si no, que toma el input amount y le baje al valor que tiene */
                   }else if(element.name == "amount"){
                        element.value--;
                   }
                });
                
            }
        }
    }

    /* "connectedCallback()"" es un método de ciclo del web component */
    connectedCallback(){
        /* Invoca la función this.components(), que obtiene HTML  Y devuelve una promesa*/
        this.components().then(html=>{
            /* Al cumplirse la promesa el contenido HTML recibido se le asigna a innerHTML  */
            this.innerHTML = html;
            /* se le asigna a la variable "container" que se igual al id "#products" del html*/
            this.container = this.querySelector("#products");
            /* se le hace un evento de escucha al la variable container y al hacerle click, se ejecute la función "selection" */
            this.container.addEventListener("click", this.selection);
        })
    }
}

/*  Se utiliza customElements.define() para registrar el elemento personalizado en el DOM con el nombre "my-body" y la clase myBody*/
customElements.define('my-body',myBody);
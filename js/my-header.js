/* Esta línea importa los estilos CSS de Bootstrap desde una URL externa y los asigna a la variable styles. */
import styles from "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" assert { type: "css" };

/* Se define la clase "myBody" que extiende de HTMLElement, (representa un elemento HTML personalizado / Web component)  */
export class myHeader extends HTMLElement{

    /* Se llama al constructor de la clase padre (HTMLElement) utilizando super()*/
    constructor(){
        super();
    }

    /* Función asincrónica components() solicita obtener el contenido del archivo "my-body.html" ubicado en la carpeta"view". Y Devuelve el contenido como una cadena de texto. */
    async components(){
        return await (await fetch("view/my-header.html")).text();
    }

    /* "connectedCallback()"" es un método de ciclo de vida en JavaScript para los elementos personalizados. */
    connectedCallback() {
        /* Se añaden los estilos importados por el documento*/
        document.adoptedStyleSheets.push(styles);

        /* Invoca la función this.components(), que obtiene el contenido HTML de algún lugar. Y devuelve una promesa de que el contenido HTML será entregado en el futuro.*/
        this.components().then(html=>{
            /*  Al cumplirse la promesa el contenido HTML recibido se le asigna a innerHTML */
            this.innerHTML=html;
        })
    }
}

/* Se utiliza customElements.define() para registrar el elemento personalizado en el DOM con el nombre "my-header" y la clase myHeader. */
customElements.define("my-header",myHeader);
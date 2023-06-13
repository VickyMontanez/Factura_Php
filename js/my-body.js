/* Se importan los estilos y se le pasan a la variable styles */
import styles from "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" assert { type: "css" };

/* Se define la clase "myBody" que se extiende de HTMLElement (Web Component) */
export class myBody extends HTMLElement {

    /* Se llama al constructor de la clase padre utilizando "super()"  */
    constructor() {
        super();
        /* Se añaden los estilos importados */
        document.adoptedStyleSheets.push(styles);
    }

    /* Función que solicita el contenido del archivo "my-body.html" y devuelve en texo */
    async components() {
        return await (await fetch("view/my-body.html")).text();
    }

    /* Función "add" para añadir un web component para los articulos */
    async add(e) {
        /* Hace referencia al elemento especifico al que se hizo click */
        let $ = e.target;
        /* función que verifica si el nombre del nodo al que se le hizo click es igual a "BUTTON" */

        /* nodeName = Devuelve el nombre del nodo en string */
        /* Si el nombre del nodo presionado es "BUTTON", entonces... */
        if ($.nodeName == "BUTTON") {
            /* Con "this", podemos acceder a las propiedades y métodos del objeto actual */

            /*"this", nos permite trabajar con los elementos y datos asociados a ese objeto dentro de la función. */

            /* ... Se le asigna a la propiedas "this.plantilla" una lista de los elementos hijos de ese elemento encontrado "#products"*/
            this.plantilla = this.querySelector("#products").children;
            /* ... Luego, se le asigna el indice del ultimo elemento de la lista */
            this.plantilla = this.plantilla[this.plantilla.length - 1];
            /* ...Se clona ese último nodo y se le asigna a "this.plantilla" */
            this.plantilla = this.plantilla.cloneNode(true);
            /* ...Y esa copia se inserta antes del final (beforeend) en el elemento seleccionado "#products" */
            document.querySelector("#products").insertAdjacentElement("beforeend", this.plantilla);
        }
    }

    /* Función "send" para enviar los datos de los dos formularios */
    send(e){
        /* Se le asigna a la variable "input" TODOS ,os inputs que se encuentren en el documento */
        let input = document.querySelectorAll("input");
        /* Estas variables se utilizan como limites en el bucle... fromInput se refiere a los indices de un array de inputs del primer formulario que contiene 8 elementos y fromProduct se refiere a los inputs que existen en el segundo formulario */
        let fromInput = 7, fromProduct = 4;
        let info = {}, producto = {}, lista = {}, data = {}, count = 0;
        producto.product = [];
        /* Se recorren todos los inputs */
        input.forEach((val, id) => {
            /* Se verifica si el indice es menor o ingual a fromInput */
            if (id <= fromInput) {
                /* Si es así se guarda la información del input en el objeto info como key => value (nombreDelInput => valorDelInput) */
                info[val.name] = val.value;

            /* Se verifica si count es menor o igual a fromProduct*/
            } else if (count <= fromProduct) {
                /* Si es así se guarda la información del input en el objeto lista como key => value y aumenta el valor de count*/
                lista[val.name] = val.value;
                count++;
                /* Si count alcanza el valor de fromProduct seagrega el objeto "lista" al array "producto.product", se vacia la lista y count se reinicia a 0; (ESTO PARA GUARDAR TODA LA INFO DE CUANTOS PRODUCTOS QUERAMOS)*/
                if (count == fromProduct) {
                producto.product.push(lista);
                lista = {};
                count = 0;
                }
            }
        });

        /* DIFERENCIAR INFO DEL CLIENTE E INFO DEL PRODUCTO */

        /* data. info ---> es una propiedad del objeto data que se le asigna = al objeto info; es decir, que los datos almacenados en "info" se asignaran a la propiedadinfo dentro de "data" */
        console.log(data.info = info);

        /* data.producto ---> es una propiedad también del objeto data que se le asigna al array "producto.product"; es decir, que a todos los elementos del array se le asignara la propiedad "producto" dentro del objeto "data" */
        console.log(data.producto = producto.product);
    }

    /* "connectedCallback()"" es un método de ciclo del web component */
    connectedCallback() {
        /* Invoca la función this.components(), que obtiene HTML  Y devuelve una promesa*/
        this.components().then(html => {
            /* Al cumplirse la promesa el contenido HTML recibido se le asigna a innerHTML  */
            this.innerHTML = html;
            /* A la función del objeto "this.add" y al elemento "#add" (BOTON ADD) y se le asigna un evento de escucha que al hacer click se  ejecute la función add */
            this.add = this.querySelector("#add").addEventListener("click", this.add.bind(this));

            /* A la función del objeto "this.send" y al elemento "#send" (BUTON SEND) y se le asigna un evento de escucha que al hacer click se  ejecute la función add */
            this.send = this.querySelector("#send").addEventListener("click", this.send.bind(this));

        })
    }
}

/*  Se utiliza customElements.define() para registrar el elemento personalizado en el DOM con el nombre "my-body" y la clase myBody*/
customElements.define('my-body', myBody);

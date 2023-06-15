/*Se crea la BASE DE DATOS*/
CREATE DATABASE db_hunter_facture_vicky;
/*Se utiliza la base de datos*/
USE db_hunter_facture;
/*Se ELIMINA la BASE DE DATOS*/
DROP DATABASE Vicky;
CREATE TABLE tb_bill(
    n_bill VARCHAR(25) NOT NULL PRIMARY KEY COMMENT "N° de la Factura único con las combinaciones necesarias",
    bill_date DATETIME NULL DEFAULT NOW() UNIQUE COMMENT "Fecha cuando se genero la factura"
);
CREATE TABLE tb_client(
    client_id INTEGER(11) NOT NULL PRIMARY KEY COMMENT "N° de Cédula del Cliente",
    client_fullname TEXT(50) NOT NULL COMMENT "Nombre Completo del Cliente",
    client_email VARCHAR(225) NOT NULL COMMENT "Email del CLiente",
    client_address VARCHAR(225) NOT NULL COMMENT "Direción del Cliente",
    client_phone BIGINT(10) NOT NULL COMMENT "Telefono del Cliente"
);
CREATE TABLE tb_product(
    product_id INT(11) NOT NULL PRIMARY KEY COMMENT "Id del Producto",
    product_name TEXT(50) NOT NULL COMMENT "Nombre del Producto",
    product_amount INT(125) NOT NULL COMMENT "Cantidad a llevar del Producto",
    product_value INT(125) NOT NULL COMMENT "Valor del Producto"
);
CREATE TABLE tb_seller(
    seller_id INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT "Id del Vendedor encargado",
    seller_name TEXT(50) NOT NULL COMMENT "Nombre del Vendedor"
);



/*Creamos los campos de las llaves foraneas*/
ALTER TABLE tb_bill ADD fk_seller_id INTEGER(11) NOT NULL COMMENT "Relación con la tabla tb_seller";
ALTER TABLE tb_bill ADD fk_client_id INTEGER(11) NOT NULL COMMENT "Relación con la tabla tb_client";
ALTER TABLE tb_bill ADD fk_product_id INT(11) NOT NULL COMMENT "Relación con la tabla tb_product";



/*Creamos las relaciones de las bases de datos*/
ALTER TABLE tb_bill ADD CONSTRAINT tb_bill_tb_client_fk FOREIGN KEY(fk_client_id) REFERENCES tb_client(client_id);
ALTER TABLE tb_bill ADD CONSTRAINT tb_bill_tb_seller_fk FOREIGN KEY(fk_seller_id) REFERENCES tb_seller(seller_id);
ALTER TABLE tb_bill ADD CONSTRAINT tb_bill_tb_product_fk FOREIGN KEY(fk_product_id) REFERENCES tb_product(product_id);



/* Se inserta data en la tabla */
INSERT INTO tb_client(identificacion, full_name, email, address, phone) VALUES("234567890","Vicky Vanessa Montañez Molina", "vmontanez707@gmail.com","Cll 56", "+57 322454");

/* Se selecciona data y se le coloca un ALIAS(AS) a la tabla */
SELECT client_fullname AS "full's_names" FROM tb_client;

/* Selecciona TODOS los datos de la tabla */
SELECT * FROM tb_client;

/* SELECCIONA un tipo de dato DESDE una tabal DONDE la idetificación sea = 234567890*/
SELECT full_name FROM tb_client WHERE identificacion=234567890;

/* Seleciona todos los datos de la tabla y los ordena por nombre */
SELECT * FROM tb_client ORDER BY full_name,email;

/* Seleccionar un rango de todos los datos */
SELECT * FROM tb_client LIMIT 0,14;

/* Selecciona desde la posición 8, los 3 datos siguientes*/
SELECT * FROM tb_client LIMIT 3 OFFSET 8;

/* Pinta cuantos registros hay */
SELECT COUNT(*) FROM tb_client;

/* Todos los registros de la tabla tb_client se almacenan en la variable @AAA */
SELECT COUNT(*) INTO @AAA FROM tb_client;

/* Seleccionemos la variable @AAA */
SELECT @AAA;

/* Actualizar data en la tabla a través de la PRIMARY KEY */
UPDATE tb_client SET full_name = "Vickisiiiita", address = "micasa", phone = 3224543241, identificacion= 1095792883 WHERE identificacion = 234567890;
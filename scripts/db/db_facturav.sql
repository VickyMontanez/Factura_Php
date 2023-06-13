//*Se crea la BASE DE DATOS*/
CREATE DATABASE db_hunter_facture_vicky;

//*Se usa la BASE DE DATOS*/
USE db_hunter_facture_vicky;

//*Se ELIMINA la BASE DE DATOS*/
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

//*CREAMOS RELACIONES DE BASE DE DATOS*/

ALTER TABLE tb_bill ADD fk_seller_id INTEGER(11) NOT NULL COMMENT "Relación con la tabla tb_seller";
ALTER TABLE tb_bill ADD fk_client_id INTEGER(11) NOT NULL COMMENT "Relación con la tabla tb_client";
ALTER TABLE tb_bill ADD fk_product_id INT(11) NOT NULL COMMENT "Relación con la tabla tb_product";
ALTER TABLE tb_bill ADD CONSTRAINT tb_bill_tb_client_fk FOREIGN KEY(fk_client_id) REFERENCES tb_client(client_id);
ALTER TABLE tb_bill ADD CONSTRAINT tb_bill_tb_seller_fk FOREIGN KEY(fk_seller_id) REFERENCES tb_seller(seller_id);
ALTER TABLE tb_bill ADD CONSTRAINT tb_bill_tb_product_fk FOREIGN KEY(fk_product_id) REFERENCES tb_product(product_id);




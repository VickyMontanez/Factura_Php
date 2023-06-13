<?php
/* Se declara una nueva clase */
class products{
    /* Se utiliza el trait "getInstance" */
    use getInstance;
    /* Y recibe parametros público */
    function __construct(public $id_product,public $name_product, public $amount, public $value_product){}
}
?>
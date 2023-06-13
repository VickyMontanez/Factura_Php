<?php
/* Se declara una nueva clase */
class seller{
    /* Se utiliza el trait "getInstance" */
    use getInstance;
    /* Y recibe un parametro público */
    function __construct(public $Seller){}
}
?>
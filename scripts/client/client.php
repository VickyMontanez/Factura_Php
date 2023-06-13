<?php
/* Se declara una nueva clase */
class client{
    /* Se utiliza el trait "getInstance" */
    use getInstance;
    /* Y recibe  parametros público */
    function __construct(public $Identification,public $Full_Name, public $Email, public $Address, public $Phone){}
}
?>
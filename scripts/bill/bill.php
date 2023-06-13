<?php
/* Se declara una nueva clase */
class bill{
    /* Se utiliza el trait "getInstance" */
    use getInstance;
    /* Y recibe parametros público */
    function __construct(public $N_Bill,public $Bill_Date){}

}
?>
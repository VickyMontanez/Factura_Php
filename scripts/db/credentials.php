<?php
/* Se declara una nueva clase */
    abstract class credentials{
        /* Se utiliza el trait "getInstance" */
        /* use getInstance; */
        protected $host = '172.16.48.210';
        private $user = 'sputnik';
        private $password = 'Sp3tn1kC@';
        protected $dbname='db_hunter_facture';

        public function __get($name){
            return $this->{$name};
        }
    }

    
?>

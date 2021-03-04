<?php

require_once('Personnage.php');

class InfantryMan extends Personnage{

    private $maxpv = 130;
    private $maxatk = 30;

    public function get_maxpv(){

        return $this -> maxpv;

    }

    public function get_maxatk(){

        return $this -> maxatk;

    }

}

?>
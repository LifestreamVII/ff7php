<?php

require_once('Personnage.php');

class SOLDIER extends Personnage{

    private $maxpv = 500; // max HPs for SOLDIERs
    private $maxatk = 120; // max ATK for SOLDIERs

    public function get_maxpv(){

        return $this -> maxpv;

    }

    public function get_maxatk(){

        return $this -> maxatk;

    }

    // public function heal($x){
        
    //     $this -> pv += $x;

    // }

    public function magic($materia, $personnage){
        
        if ($materia -> type == "heal")
        $personnage -> pv += $materia -> pv;
        else{
        if ($materia -> type == "atk")
        $personnage -> pv -= $materia -> atk;
        }
    }

}

?>
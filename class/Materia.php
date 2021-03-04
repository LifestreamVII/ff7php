<?php

class Materia{

    private $atk;
    private $pv;
    private $name;
    private $color;
    private $type;

    public function __construct($atk, $pv, $type, $name, $color){
        $this -> set_pv($pv);
        $this -> set_atk($atk);
        $this -> set_name($name);
        $this -> set_type($type);
        $this -> set_color($color);
    }

    public function set_atk($atk){

        $this -> atk = $atk;

    }

    public function set_pv($pv){

        $this -> pv = $pv;

    }

    public function set_type($type){

        $this -> type = $type;

    }

    public function set_name($name){

        $this -> name = $name;

    }

    public function set_color($color){

        $this -> color = $color;

    }

    public function get_name(){

        return $this -> name;

    }

}

?>
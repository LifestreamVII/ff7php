<?php

class Personnage{

    private $pv;
    private $selsprite;
    private $id;
    private $atk;
    private $name;
    private static $countchars;
    const MAXLIFE = 200;

    public function __construct($id, $pv, $atk, $name, $selsprite){
        $this -> set_id($id);
        $this -> set_pv($pv);
        $this -> set_atk($atk);
        $this -> set_name($name);
        $this -> set_selsprite($selsprite);
        self::$countchars++;
    }

    public function get_id(){

        return $this -> id;

    }

    public function get_pv(){

        return $this -> pv;

    }

    public function get_selsprite(){

        return $this -> selsprite;

    }

    public function set_pv($pv){

        if ($pv > $this -> get_maxpv())
        $pv = $this -> get_maxpv();
        $this -> pv = $pv;

    }

    public function get_atk(){

        return $this -> atk;

    }

    public function set_atk($atk){

        if ($atk > $this -> get_maxatk())
        $atk = $this -> get_maxatk();
        $this -> atk = $atk;

    }

    public function get_name(){

        return $this -> name;

    }

    public static function count_chars(){
        return self::$countchars;
    }

    public static function reinit_life(){
        $this->set_pv(self::MAXLIFE);
    }

    public function set_name($name){

        $this -> name = $name;

    }

    public function set_id($id){

        $this -> id = $id;

    }

    public function set_selsprite($selsprite){

        $this -> selsprite = $selsprite;

    }

    public function isAlive(){

        return $this -> pv > 0;

    }

    public function attaquer(Personnage $personnage, $x){
        
        $personnage -> pv -= $x;

    }

}

?>
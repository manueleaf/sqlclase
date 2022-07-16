<?php

class Curso
{



    private $idCurso;
    private $nombre;
    private $profesor;
    
    
    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}
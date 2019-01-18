<?php
namespace app\model;

use core\mvc\Model;

class BebidaModel extends Model
{

    private $descricaobebida;
    private $tipobebida;
    private $recipiente;
    

    public function __construct(
        $id = null,
        $descricaobebida = null,
        $tipobebida = null,
        $recipiente = null
          
    )
    {
        parent::__construct($id);
        $this->descricaobebida = $descricaobebida;
        $this->tipobebida = $tipobebida;
        $this->recipiente = $recipiente;            
    }

    public function setDescricaoBebida($descricaobebida){
        $this->descricaobebida = $descricaobebida;
    }

    public function setTipoBebida($tipobebida){
        $this->tipobebida = $tipobebida;
    }

    public function setRecipiente($recipiente){
        $this->recipiente = $recipiente;
    }
   
    public function getDescricaoBebida(){
        return $this->descricaobebida;
    }

    public function getTipoBebida(){
        return $this->tipobebida;
    }

    public function getRecipiente(){
        return $this->recipiente;
    } 

    public function show() {

    }   

}
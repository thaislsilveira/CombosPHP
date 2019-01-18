<?php
namespace app\model;

use core\mvc\Model;

class ComidaSalgadaModel extends Model
{

    private $descricaocomida;
    private $tipocomida;
       

    public function __construct(
        $id = null,
        $descricaocomida = null,
        $tipocomida = null              
    )
    {
        parent::__construct($id);
        $this->descricaocomida = $descricaocomida;
        $this->tipocomida = $tipocomida;              
    }

    public function setDescricaoComida($descricaocomida){
        $this->descricaocomida = $descricaocomida;
    }

    public function setTipoComida($tipocomida){
        $this->tipocomida = $tipocomida;
    }

    public function getDescricaoComida(){
        return $this->descricaocomida;
    }

    public function getTipoComida(){
        return $this->tipocomida;
    }  

    public function show() {

    }   

}
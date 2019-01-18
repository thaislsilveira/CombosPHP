<?php

namespace app\model;

use core\mvc\Model;

final class ComboModel extends Model {

    private $precototal;
    private $usuario;
    private $bebida;
    private $comidaSalgada;
    private $doce;

    public function __construct(
    $id = null, $precototal = 0, UsuarioModel $usuario = null, BebidaModel $bebida = null, ComidaSalgadaModel $comidaSalgada = null, DoceModel $doce = null
    ) {
        parent::__construct($id);
        $this->precototal = $precototal;
        $this->usuario = is_null($usuario) ? new UsuarioModel() : $usuario;
        $this->bebida = is_null($bebida) ? new BebidaModel() : $bebida;
        $this->comidaSalgada = is_null($comidaSalgada) ? new ComidaSalgadaModel() : $comidaSalgada;
        $this->doce = is_null($doce) ? new DoceModel() : $doce;
    }

    /**
     * Get the value of description
     */
    public function getPrecoTotal() {
        return $this->precototal;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setPrecoTotal($precototal) {
        $this->precototal = $precototal;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUsuario(UsuarioModel $usuario) {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setBebida(BebidaModel $bebida) {
        $this->bebida = $bebida;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getBebida() {
        return $this->bebida;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setComidaSalgada(ComidaSalgadaModel $comidaSalgada) {
        $this->comidaSalgada = $comidaSalgada;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getComidaSalgada() {
        return $this->comidaSalgada;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setDoce(DoceModel $doce) {
        $this->doce = $doce;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getDoce() {
        return $this->doce;
    }

    public function show() {
        
    }

    public function getUsuarioAsString() {
        return "{$this->usuario->getNome()}";
    }

    public function getBebidaAsString() {
        return "{$this->bebida->getDescricaoBebida()}";
    }

    public function getComidaSalgadaAsString() {
        return "{$this->comidaSalgada->getDescricaoComida()}";
    }

    public function getDoceAsString() {
        return "{$this->doce->getDescricaoDoce()}";
    }

}

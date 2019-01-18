<?php

namespace app\view\combo;

use core\mvc\view\HtmlPage;
use app\model\ComboModel;

final class ComboView extends HtmlPage {

    protected $usuarios;
    protected $bebidas;
    protected $comidasalgadas;
    protected $doces;

    public function __construct(BebidaModel $model = null) {
        $this->model = is_null($model) ? new ComboModel() : $model;
        $this->htmlFile = 'app/view/combo/combo_view.phtml';
    }

    public function setUsuarios($usuarios) {
        $this->usuarios = $usuarios;
    }

    public function getUsuarios() {
        $this->usuarios;
    }

    public function setBebidas($bebidas) {
        $this->bebidas = $bebidas;
    }

    public function getBebidas() {
        $this->bebidas;
    }

    public function setComidaSalgadas($comidasalgadas) {
        $this->comidasalgadas = $comidasalgadas;
    }

    public function getComidaSalgadas() {
        $this->comidasalgadas;
    }

    public function setDoces($doces) {
        $this->doces = $doces;
    }

    public function getDoces() {
        $this->doces;
    }

}

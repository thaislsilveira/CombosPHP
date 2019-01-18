<?php

namespace app\controller;

use core\mvc\Controller;
use app\model\ComidaSalgadaModel;
use app\view\comidasalgada\ComidaSalgadaView;
use app\dao\ComidaSalgadaDao;
use app\view\comidasalgada\ComidaSalgadaList;

class ComidaSalgadaCtr extends Controller {

    public function __construct() {
        parent::__construct();
        $this->model = new ComidaSalgadaModel();
        $this->view = new ComidaSalgadaView();
        $this->dao = new ComidaSalgadaDao();
        $this->viewList = new ComidaSalgadaList(); //..instanciar a view de listagem.
    }

    public function viewToModel() {
        if ($this->post) {
            $this->model->setId($this->post['id']);
            $this->model->setDescricaoComida($this->post['descricao']);
            $this->model->setTipoComida($this->post['tipo']);
        }
    }

    public function showList() {
        if ($this->post) {
            $this->criteria = "upper (" . ComidaSalgadaDao::COL_DESCRICAO . ") like upper('{$this->post['data'][0]}')";
            $this->orderBy = ComidaSalgadaDao::COL_DESCRICAO;
        }
        parent::showList();
    }

}

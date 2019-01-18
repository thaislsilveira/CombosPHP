<?php

namespace app\controller;

use core\mvc\Controller;
use app\model\BebidaModel;
use app\view\bebida\BebidaView;
use app\dao\BebidaDao;
use app\view\bebida\BebidaList;

class BebidaCtr extends Controller {

    public function __construct() {
        parent::__construct();
        $this->model = new BebidaModel();
        $this->view = new BebidaView();
        $this->dao = new BebidaDao();
        $this->viewList = new BebidaList(); //..instanciar a view de listagem.
    }

    public function viewToModel() {
        if ($this->post) {
            $this->model->setId($this->post['id']);
            $this->model->setDescricaoBebida($this->post['descricao']);
            $this->model->setTipoBebida($this->post['tipo']);
            $this->model->setRecipiente($this->post['recipiente']);
        }
    }

    public function showList() {
        if ($this->post) {
            $this->criteria = "upper (" . BebidaDao::COL_DESCRICAO . ") like upper('{$this->post['data'][0]}')";
            $this->orderBy = BebidaDao::COL_DESCRICAO;
        }
        parent::showList();
    }

}

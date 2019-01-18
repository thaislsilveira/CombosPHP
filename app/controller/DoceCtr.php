<?php

namespace app\controller;

use core\mvc\Controller;
use app\model\DoceModel;
use app\view\doce\DoceView;
use app\dao\DoceDao;
use app\view\doce\DoceList;


class DoceCtr extends Controller{

    public function __construct() {
        parent::__construct();
        $this->model = new DoceModel();
        $this->view = new DoceView();
        $this->dao = new DoceDao();
        $this->viewList = new DoceList(); //..instanciar a view de listagem.
    }

    public function viewToModel() {
        if($this->post) {
            $this->model->setId($this->post['id']);
            $this->model->setDescricaoDoce($this->post['descricao']);
            $this->model->setTipoDoce($this->post['tipo']);
        }
    }

    public function showList() {
        if($this->post){
            $this->criteria = "upper (" . DoceDao::COL_DESCRICAO . ") like upper('{$this->post['data'][0]}')";
            $this->orderBy = DoceDao::COL_DESCRICAO;
        }
        parent::showList();
    }

}
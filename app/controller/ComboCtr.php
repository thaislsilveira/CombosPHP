<?php

namespace app\controller;

use core\mvc\Controller;
use app\model\ComboModel;
use app\view\combo\ComboView;
use app\dao\ComboDao;
use app\view\combo\ComboList;
use app\model\BebidaModel;
use app\dao\BebidaDao;
use app\model\DoceModel;
use app\dao\DoceDao;
use app\model\ComidaSalgadaModel;
use app\dao\ComidaSalgadaDao;
use app\model\UsuarioModel;
use app\dao\UsuarioDao;
use core\util\Session;

final class ComboCtr extends Controller {

    public function __construct() {
        parent::__construct();
        //..instanciar os objetos que o controller irá manipular
        $this->model = new ComboModel();
        $this->dao = new ComboDao();
        $this->view = new ComboView();
        $this->viewList = new ComboList();
    }

    public function viewToModel() {
        //..se existir algo no post, então...

        if ($this->post) {
            $this->model->setId($this->post['id']);
            $this->model->setPrecoTotal($this->post['precoTotal']);
            $this->model->setUsuario(new UsuarioModel($this->post['idUsuario']));
            $this->model->setBebida(new BebidaModel($this->post['idBebida']));
            $this->model->setComidaSalgada(new ComidaSalgadaModel($this->post['idComidaSalgada']));
            $this->model->setDoce(new DoceModel($this->post['idDoce']));
        }
    }

    public function showView() {
        //..recupera as categorias para exibir na view 
        $usuarios = (new UsuarioDao())->selectAll();
        $this->view->setUsuarios($usuarios);
        $bebidas = (new BebidaDao())->selectAll();
        $this->view->setBebidas($bebidas);
        $doces = (new DoceDao())->selectAll();
        $this->view->setDoces($doces);
        $comidasalgadas = (new ComidaSalgadaDao())->selectAll();
        $this->view->setComidaSalgadas($comidasalgadas);
        parent::showView();
    }

    public function showJson() {
        if (isset($this->get['id'])) { //..verifica se existe uma variável id no get                    
            $id = $this->get['id']; //..pega o id 
            //..recupera o modelo fazendo uma consulta no bando por id
            $this->model = $this->dao->findById($id);
        }
        $usuarios = (new UsuarioDao())->selectAll();
        if ($usuarios) {
            $array['usuarios'] = [];
            foreach ($usuarios as $key => $usuario) {
                $array['usuarios'][$key]['id'] = $usuario->getId();
                $array['usuarios'][$key]['nome'] = $usuario->getNome();
                $array['usuarios'][$key]['selected'] = $usuario->getId() == $this->model->getUsuario()->getId() ? "selected" : "";
            }
        }

        $bebidas = (new BebidaDao())->selectAll();
        if ($bebidas) {
            $array['bebidas'] = [];
            foreach ($bebidas as $key => $bebida) {
                $array['bebidas'][$key]['id'] = $bebida->getId();
                $array['bebidas'][$key]['descricao'] = $bebida->getDescricaoBebida();
                $array['bebidas'][$key]['selected'] = $bebida->getId() == $this->model->getBebida()->getId() ? "selected" : "";
            }
        }

        $doces = (new DoceDao())->selectAll();
        if ($doces) {
            $array['doces'] = [];
            foreach ($doces as $key => $doce) {
                $array['doces'][$key]['id'] = $doce->getId();
                $array['doces'][$key]['descricao'] = $doce->getDescricaoDoce();
                $array['doces'][$key]['selected'] = $doce->getId() == $this->model->getDoce()->getId() ? "selected" : "";
            }
        }

        $comidasalgadas = (new ComidaSalgadaDao())->selectAll();
        if ($comidasalgadas) {
            $array['comidasalgadas'] = [];
            foreach ($comidasalgadas as $key => $comidasalgada) {
                $array['comidasalgadas'][$key]['id'] = $comidasalgada->getId();
                $array['comidasalgadas'][$key]['descricao'] = $comidasalgada->getDescricaoComida();
                $array['comidasalgadas'][$key]['selected'] = $comidasalgada->getId() == $this->model->getComidaSalgada()->getId() ? "selected" : "";
            }
        }
        echo json_encode($array);
    }

    public function showList() {
        if ($this->post) {
            $this->orderBy = ComboDao::COL_PRECOTOTAL;
        }
        parent::showList();
    }

}

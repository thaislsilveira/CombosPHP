<?php

namespace app\view\usuario;
use core\mvc\view\HtmlPage;
use app\model\UsuarioModel;

class UsuarioView extends HtmlPage{

    public function __construct(UsuarioModel $model = null) {
        $this->model = \is_null($model) ? new UsuarioModel() : $model;
        $this->htmlFile = 'app/view/usuario/usuario_view.phtml';       
    }
}
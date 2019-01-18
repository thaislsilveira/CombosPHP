<?php
namespace app\view\bebida;

use core\mvc\view\HtmlPage;
use app\model\BebidaModel;


final class BebidaView extends HtmlPage{


    public function __construct(BebidaModel $model = null)
    {
        $this->model = is_null($model) ? new BebidaModel() : $model;
        $this->htmlFile = 'app/view/bebida/bebida_view.phtml';
    }


}

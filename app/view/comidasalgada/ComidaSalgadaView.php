<?php
namespace app\view\comidasalgada;

use core\mvc\view\HtmlPage;
use app\model\ComidaSalgadaModel;


final class ComidaSalgadaView extends HtmlPage{


    public function __construct(ComidaSalgadaModel $model = null)
    {
        $this->model = is_null($model) ? new ComidaSalgadaModel() : $model;
        $this->htmlFile = 'app/view/comidasalgada/comidasalgada_view.phtml';
    }


}

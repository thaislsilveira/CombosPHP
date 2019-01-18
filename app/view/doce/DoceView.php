<?php
namespace app\view\doce;

use core\mvc\view\HtmlPage;
use app\model\DoceModel;


final class DoceView extends HtmlPage{


    public function __construct(DoceModel $model = null)
    {
        $this->model = is_null($model) ? new DoceModel() : $model;
        $this->htmlFile = 'app/view/doce/doce_view.phtml';
    }


}

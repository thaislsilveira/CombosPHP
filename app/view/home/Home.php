<?php

namespace app\view\home;

use core\mvc\view\HtmlPage;
use core\util\Session;

class Home extends HtmlPage {

    protected $msgError;

    public function __construct($msgError = null) {
        $this->htmlFile = 'app/view/home/home.phtml';
        $this->msgError = $msgError;
    }

    public function show() {
        if (Session::getSession('activeUsuario')) {
            parent::drawHeader();
            require_once $this->htmlFile;
            parent::drawFooter();
        } else {
            require_once 'app/view/home/login.phtml';
        }
    }

}

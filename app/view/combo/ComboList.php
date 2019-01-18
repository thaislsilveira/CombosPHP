<?php
namespace app\view\combo;

use core\mvc\view\HtmlPage;

final class ComboList extends HtmlPage
{
    public function __construct($model = null, $sqlData = null, $regPerPage = null, $currentPage = null, $previousPage = null, $nextPage = null, $lastPage = null)
    {
        parent::__construct($model, $sqlData, $regPerPage, $currentPage, $previousPage, $nextPage, $lastPage);
        $this->htmlFile = 'app/view/combo/combo_list.phtml';
    }

}
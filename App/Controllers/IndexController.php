<?php

namespace App\Controllers;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use MF\Controller\Action;


class IndexController extends Action
{
    
    public function index() {
        $this->view->dados = 'alow';
        $this->render('index','base' );
    }
    
}

?>

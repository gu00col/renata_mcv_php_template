<?php

namespace App\Controllers;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('./logs.php');

use MF\Controller\Action;
use MF\Model\Container;

use App\Models\Usuario;

class IndexController extends Action
{
    
    public function index() {

        // $usuario = Container::getModel('Usuario');
        
        // $usuarios = $usuario->getUsuarios(); 

        // $this->view->dados = $usuarios;
        $this->render('index','base' );
    }
    
}

?>

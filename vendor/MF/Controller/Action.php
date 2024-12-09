<?php

namespace MF\Controller;
require_once('./logs.php');
abstract class Action
{

    protected $view;
    public function __construct()
    {
        // echo 'Carregando o IndexController <br>';
        $this->view = new \stdClass();
    } 

    // Método para renderizar as views
    protected function render($view,$layout='base')
    {
        $this->view->page = $view;
      require_once './App/Views/layouts/'.$layout.'.phtml';

    }
    protected function content(){
        $classPath = get_class($this);
        $classPathEdit = strtolower(str_replace('Controller', '', str_replace('App\\Controllers\\', '', $classPath)));
        $viewPath = './App/Views/' . $classPathEdit . '/' . $this->view->page . '.phtml';

        $data = $this->view;

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo 'View não encontrada: ' . $viewPath;
        }
    }
}

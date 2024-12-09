<?php 

namespace MF\Init;



function formatPathName($path)
{
    //echo 'Iniciando formatPathName <br>';

    // Obtém o diretório pai três níveis acima do diretório atual
    $greatGrandParentDirName = basename(dirname(dirname(dirname(__DIR__))));

    //echo 'greatGrandParentDirName: ' . $greatGrandParentDirName . ' <br>';

    // Remove a substring correspondente ao nome do diretório pai três níveis acima
    $substring = '/' . $greatGrandParentDirName;
    $pathFormat = str_replace($substring, '', $path);

    //echo 'pathFormat: ' . $pathFormat . ' <br>';
    return $pathFormat;
}




 

abstract class Bootstrap { 

    private $routes;

    abstract protected function initRoute();

    public function __construct()
    {
        //echo 'Iniciando Route <br>';
        $this->initRoute();
        $this->run($this->getUrl());
    }

    public function getRoutes()
    {
        //echo 'Iniciando getRoutes <br>';
        return $this->routes;
    }

    public function setRoutes(array $routes)
    {
        //echo 'Iniciando setRoutes <br>';
        $this->routes = $routes;
    }
    protected function run($url)
    {
        foreach ($this->getRoutes() as $index => $route) {
            //echo $url . ':' . $route['route'] . '<br>';
            if ($url == $route['route']) {
                //echo 'Estou na rota '.$route['route']. '<br>';
                //echo ucfirst($route['controller']);
                $class = 'App\\Controllers\\' . ucfirst($route['controller']);
                //echo 'Carregando o controller '. $class . '<br>';
                $controller = new $class;
                $action = $route['action'];
                $controller->$action();
            }
        }
    }
    protected function getUrl()
    {
        //echo 'Iniciando getUrl <br>';
        return formatPathName(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }

}

?>
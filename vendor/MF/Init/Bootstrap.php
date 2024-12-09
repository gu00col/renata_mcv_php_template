<?php 

namespace MF\Init;
require_once('./logs.php');


function getDynamicPath($projectName)
{
    // Obtém o caminho da aplicação
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Remove a barra inicial, se existir, para evitar um elemento vazio no array
    if (substr($path, 0, 1) === '/') {
        $path = substr($path, 1);
    }

    // Divide o caminho em um array usando o caractere '/'
    $pathArray = explode('/', $path);
    // Encontra a posição da pasta do projeto
    $projectKey = array_search($projectName, $pathArray);

    // Se a pasta do projeto for encontrada, cria o novo caminho a partir dela
    if ($projectKey !== false) {
        $dynamicPathArray = array_slice($pathArray, $projectKey + 1);
        $dynamicPath = '/' . implode('/', $dynamicPathArray);
    } else {
        // Se a pasta do projeto não for encontrada, retorna o caminho original
        $dynamicPath = $path;
    }
    //logMessage('$dynamicPath: '.$dynamicPath);
    return $dynamicPath;
}



 

abstract class Bootstrap { 

    private $routes;
    protected $projectName;

    abstract protected function initRoute();

    public function __construct($projectName)
    {
        $this->projectName = $projectName;
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
                $rota = ucfirst($route['controller']);
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
        return getDynamicPath($this->projectName);
    }

}

?>
<?php

class Router 
{
    private $routes;

    public function __construct()
    {
        $routesPath=ROOT.'/config/routes.php';
        $this->routes = include($routesPath);

    }

    private function getURI() {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }

    public function run ()
    {
        $uri=$this->getURI();
        
        foreach ($this->routes as $pattern=>$path) {
            if (preg_match("~$pattern~", $uri)) {
                
                $internalRoute=preg_replace("~$pattern~", $path, $uri);

                //определние путей
                $segments=explode('/', $internalRoute);
                $controllerName =array_shift($segments).'Controller';
                $actionName=array_shift($segments).'Action';

                //на случай гет-параметров
                $parameters=array();
                foreach ($segments as $segment) {
                if (strpos($segment,'&')) {
                    $seg=explode('&', $segment);
                    foreach ($seg as $replace) {
                        array_push($parameters, preg_replace("~[a-z=]+(\d+)~","$1",$replace));
                }
                    } else {array_push($parameters,$segment);}
                }

                //подключение контроллера
                $controllerFile=ROOT.'/controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // вызвать метод
                $controllerObject= new $controllerName;
                $result=call_user_func_array(array($controllerObject,$actionName), $parameters);
                if ($result != null){
                    break;
                }
            }
        }
    }
}

?>
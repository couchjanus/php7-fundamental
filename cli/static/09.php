<?php


class Router
{
    protected $routes = [];
 
    public function define($routes)
    {
        $this->routes = $routes;
    }


    public static function load($file)
    {
        $router = new static();
        include $file;
        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

}


$obj = Router::load('routes.php');

var_dump($obj);

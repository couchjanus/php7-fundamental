<?php

    define('ROUTES', require CONFIG.'routes'.EXT);
    $result = null;

    function getURI()
    {
        if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    // function getPathAction($route)
    // {
    //     $segments = explode('\\', $route);
    //     $controller = array_pop($segments);
    //     $controllerPath = '/';

    //     do {
    //         if (count($segments)===0) {
    //             return array ($controller, $controllerPath);
    //         } else {
    //             $segment = array_shift($segments);
    //             $controllerPath = $controllerPath . $segment . '/';
    //         }
    //     } while (count($segments)>=0);
    // }


    function getPathAction($route)
    {
        list($segments, $action) = explode('@', $route);
        $segments = explode('\\', $segments);
        $controller = array_pop($segments);
        $controllerFile = '/';
        do {
            if (count($segments)===0) {
                    return array ($controller, $action, $controllerFile);
            } else {
                    $segment = array_shift($segments);
                    $controllerFile = $controllerFile.$segment.'/';
            }
        } while ( count($segments) >= 0);

    }



    function callAction($controller, $action, $controllerFile, $vars = [])
    {
        include CONTROLLERS.$controllerFile.'/'.$controller.EXT;
        
        $controller = new $controller;
        
        if (! method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }
        return $controller->$action($vars); // return $vars to the action
    }

    function directPath($uri)
    {   
        if (array_key_exists($uri, ROUTES)) {
            // var_dump(ROUTES[$uri]);
            return callAction(...getPathAction(ROUTES[$uri]));
        } else {
            foreach (ROUTES as $key => $val) {
                $pattern = preg_replace('#\(/\)#', '/?', $key);
                $pattern = "@^" .preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern). "$@D";
                preg_match($pattern, $uri, $matches);
                array_shift($matches);
                if ($matches) {
                    $getAction = getPathAction($val);
                    return callAction($getAction[0], $getAction[1], $getAction[2], $matches);
                }
            }
        }
        include_once VIEWS.'errors/404'.EXT;
        throw new Exception('No route defined for this URI.');
    }


    // получаем строку запроса

    $uri = getURI();
    
    // Проверить наличие запроса в routes

    directPath($uri);
   
    // foreach ($routes as $route => $path) {

    //     //Сравниваем route и $uri
    //     if ($route === $uri) {

    //         // Определить контроллер
    //         list($segments, $controllerPath) = getPathAction($path);
    //         list($controller, $action) = explode('@', $segments);

    //         $controllerFile = CONTROLLERS .$controllerPath . $controller . EXT;

    //         if (file_exists($controllerFile)) {
    //             include_once $controllerFile;
    //             $controller = new $controller;

    //             if (method_exists($controller, $action)) {
    //                 $controller->$action();
    //             }

    //             $result = true;
    //         }

    //         if ($result !== null) {
    //             break;
    //         }
    //     }
    // }

    // if ($result === null) {
    //         include_once VIEWS.'errors/404'.EXT;
    // }

<?php

    function getURI()
    {
        if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }


    function getPathAction($route)
    {
        $segments = explode('\\', $route);
        $controller = array_pop($segments);
        $controllerPath = '/';

        do {
            if (count($segments)===0) {
                return array ($controller, $controllerPath);
            } else {
                $segment = array_shift($segments);
                $controllerPath = $controllerPath . $segment . '/';
            }
        } while (count($segments)>=0);
    }

    // получаем строку запроса

    $uri = getURI();

    $filename = CONFIG.'routes'.EXT;

    if (file_exists($filename)) {
        $routes = include_once $filename;
    } else {
        echo "Файл $filename не существует";
    }

    // Проверить наличие такого запроса в routes

    foreach ($routes as $route => $path) {

        //Сравниваем route и $uri
        if ($route === $uri) {

            // Определить контроллер

            list($segments, $controllerPath) = getPathAction($path);

            list($controller, $action) = explode('@', $segments);

            $controllerFile = CONTROLLERS .$controllerPath . $controller . EXT;

            if (file_exists($controllerFile)) {
                include_once $controllerFile;
                $controller = new $controller;

                if (method_exists($controller, $action)) {
                    $controller->$action();
                   
                }

                $result = true;
            }

            if ($result !== null) {
                break;
            }
        }
    }

    if ($result === null) {
            include_once VIEWS.'errors/404'.EXT;
    }

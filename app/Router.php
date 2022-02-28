<?php

namespace App;


class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require  '../config/routes.php';
        foreach ($arr as $route) {
            $this->add($route);
        }
    }

    public function add($route)
    {
        $uri = $route['uri'];


        if (preg_match('#{\w+}#', $uri, $matches)) {

            $route['paramKey'] = preg_replace('#[{}]#', '', $matches[0]);
            $uri = preg_replace('#{\w+}#', '.*', $uri);
        }


        $route['uri'] ="#$uri#";
        $this->routes[] = $route;
    }

    public function match()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = str_replace('/public/','', $_SERVER['REQUEST_URI']);
        $uri = explode('?', $uri)[0];


        foreach ($this->routes as $route) {

            if ($route['method'] === $method  && preg_match($route['uri'], $uri, $matches)) {

                $rest = preg_replace($route['uri'], '', $uri);
                if ($rest === '') {
                    $deletingPartOfRoute = preg_replace('#\.\*#', '', $route['uri']);

                    if (preg_match($deletingPartOfRoute, $uri, $par)) {
                        $this->params['params'] = preg_replace($deletingPartOfRoute, '', $uri);
                        $this->params['controller'] = $route['controller'];
                        $this->params['action'] = $route['action'];
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function run()
    {
        if ($this->match()) {
            $class = 'App\Controller\\' . ucfirst($this->params['controller']) . 'Controller';
            $action = $this->params['action'];

            if (!class_exists($class)) {
                echo "Класса нет";
            } elseif (!method_exists($class, $action)){
                echo "Метода класса нет";
            } else {
                $controller = new $class;
                if (isset($this->params['params']) &&  $this->params['params'] !== '') {
                    $controller->$action($this->params['params']);
                } else {
                    $controller->$action();
                }
            }

        } else {
            echo "Маршрут не найден";
        }
    }
}
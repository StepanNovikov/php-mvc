<?php
    namespace application\core;

    class Router
    {
        protected $routes = [];
        protected $params = [];

        function __construct()
        {
            $arr = require 'application/config/routes.php';
            foreach ($arr as $key => $value){
                $this->add($key,$value);
            }
        }

        public function add($route, $params){
            $route = '#^'.$route.'$#';
            $this->routes[$route] = $params;

        }

        public function match(){
            $url = $_SERVER['REQUEST_URI'];
            $url = trim($url,'/');

            foreach ($this->routes as $route => $params){

                if(preg_match($route,$url,$matches)){
                    $this->params = $params;
                    return true;
                }
            }
            return false;
        }

        public function run(){
            if($this->match()){
                $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';

                if(class_exists($path)){
                    $action = $this->params['action'].'Action';

                    if(method_exists($path,$action)){
                        $controller = new $path($this->params);
                        $controller->$action();
                    } else{
                        echo 'Не найден экшен '.$action;
                    }
                } else{
                    echo 'Класс '.ucfirst($this->params['controller']).' не найден';
                }
            } else {
                echo 'Маршрут не найден';
            }
        }


    }
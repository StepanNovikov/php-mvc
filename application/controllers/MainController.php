<?php

    namespace application\controllers;

    use application\core\Controller;

    class MainController extends Controller{
        public function indexAction(){
//            echo "Главная старница";
            $this->view->render('Главная страница');
        }

    }
<?php

    namespace application\controllers;

    use application\core\Controller;
    use application\lib\Db;


    class MainController extends Controller{
        public function indexAction(){
            $db = new Db();

            // $form = 2;

            $params = [
                'id'=>1,
            ];

            $data = $db->column('select name from users where id = :id',$params);
            debug($data);

            $this->view->render('Главная страница');
        }

    }
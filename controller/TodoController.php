<?php
require_once('./../../model/Todo.php');
require_once('./../../validation/TodoValidation.php');


class TodoController{
    public function index(){
        $todo_list = Todo::findAll();
        return $todo_list;
    }

    public function detail(){
        $todo_id = $_GET['todo_id'];
        $todo = Todo::findById($todo_id);
        return $todo;
    }

    public function new(){
        $data = array(
            'title' => $_POST['title'],
            'detail'=> $_POST['detail'],
        );

        $validation = new Todovalidation;
        $validation->setData($data);
        if($validation->check() === false){
            $error_msgs = $validation->getErrorMessages();
            
            session_start();
            $_SESSION['error_msgs'] = $error_msgs;

            $params = sprintf('?title=%s&detail=%s', $_POST['title'], $_POST['detail']);
            header(sprintf('Location: ./new.php%s', $params));
        }

        $valid_data = $validation->getData();
        var_dump($valid_data);


        $todo = new Todo;
        $todo->setTitle($title);
        $todo->setDetail($detail);
        $result = $todo->save();

        $result = false;
        if($result === false){
            $params = sprintf('?title=%s&detail=%s', $_POST['title'], $_POST['detail']);
            header(sprintf('Location: ./new.php%s', $params));
            return;
        }

        header('Location: ./index.php');
    }
}

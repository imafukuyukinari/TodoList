<?php
require_once("../../validation/todoValidation.php");

class TodoController {
    public function index() {
        return Todo::findAll();
    }

    public function detail() {
        $todo_id = $_GET['todo_id'];

        return Todo::findById($todo_id);
    }

    public function new() {
        $data = array(
            "title" => $_POST['title'],
            "detail" => $_POST['detail'],
        );

        $validation = new TodoValidation;
        $validation->setData($data);
        if($validation->check() === false) {
            $error_msgs = $validation->getErrorMessages();

            //セッションにエラーメッセージを追加
            session_start();
            $_SESSION['error_msgs'] = $error_msgs;

            $params = sprintf("?title=%s&detail=%s", $title, $detail);
            header("Location: ./new.php" . $params);
        }

        $validate_data = $validation->getData();
        $title = $validate_data['title'];
        $detail = $validate_data['detail'];

        $todo = new Todo;
        $todo->setTitle($title);
        $todo->setDetail($detail);
        $result = $todo->save();

        if($result === false) {
            $params = sprintf("?title=%s&detail=%s", $title, $detail);
            header("Location: ./new.php" . $params);
        }

        header( "Location: ./index.php" );
    }

    public function edit() {
        $todo_id = $_GET['todo_id'];
        $todo = Todo::findById($todo_id);
        return $todo;
    }

    public function update() {
        $data = array(
            "id" => $_POST['todo_id'],
            "title" => $_POST['title'],
            "detail" => $_POST['detail']
        );

        $validation = new TodoValidation;
        $validation->setData($data);
        if($validation->check() === false) {
            $error_msgs = $validation->getErrorMessages();

            //セッションにエラーメッセージを追加
            session_start();
            $_SESSION['error_msgs'] = $error_msgs;

            $params = sprintf("?title=%s&detail=%s", $title, $detail);
            header("Location: ./new.php" . $params);
        }

        $validate_data = $validation->getData();
        $todo_id = $validate_data['id'];
        $title = $validate_data['title'];
        $detail = $validate_data['detail'];

        $todo = new Todo;
        $todo->setTitle($title);
        $todo->setDetail($detail);
        $result = $todo->update();

        $params = sprintf("?todo_id=%s", $todo_id);
        if($result === false) {
            header("Location: ./edit.php" . $params);
        }

        header("Location: ./detail.php" . $params);
    }

    public function delete() {
        $todo_id = $_GET['todo_id'];
        $is_exist = Todo::isExistById($todo_id);
        if(!$is_exist) {
            session_start();
            $_SESSION['error_msgs'] = [sprintf("id=%sに該当するレコードが存在しません。", $todo_id)];
            header("Location: ./index.php");
        }

        $todo = new Todo;
        $todo->setId($todo_id);
        $result = $todo->delete();
        if($result === false) {
            session_start();
            $_SESSION['error_msgs'] = [sprintf("削除に失敗しました。id=%s", $todo_id)];
        }

        header("Location: ./index.php");
    }
}


<?php
require_once('./../../config/database.php');

class Todo {
    public static function findByQuery($query){
        $pdo = new PDO(DSN, USERNAME, PASSWORD);
        $stmh = $pdo->query($query);
        if($stmh){
            $todo_list = $stmh->fetchAll(PDO::FETCH_ASSOC);
        }   else{
            $todo_list = array();
        }
        
        return $todo_list;

    }
        public $title;
        public $detail;
        public $status;

        public function getTitle(){
            return $this->title;
        }

        public function setTitle($title){
            $this->$title = $title;
        }

        public function getDetail(){
            return $this->detail;
        }

        public function setDetail($detail){
            $this->detail = $detail;
        }

        public function getStasus(){
            return $this->stasus;
        }

        public function setStatus($status){
            $this->status = $status;
        }



    public static function findAll(){
        $pdo = new PDO(DSN, USERNAME, PASSWORD);
        $stmh = $pdo->query('select * from todos');
        if($stmh){
            $todo_list = $stmh->fetchAll(PDO::FETCH_ASSOC);
        }   else{
            $todo_list = array();
        }
        
        return $todo_list;
    }

    public static function findById($todo_id){
        $pdo = new PDO(DSN, USERNAME, PASSWORD);
        $stmh = $pdo->query(sprintf('select * from todos where id = %s', $todo_id));
        if($stmh){
            $todo = $stmh->fetch(PDO::FETCH_ASSOC);
        }   else{
            $todo = array();
        }

        return $todo;
    }

    public function save(){
        $query = sprintf("INSERT INTO `todos` (`title`, `detail`, `status`,
                    'created_at`, `updated_at`)
                VALUES (%s , '%s', 0, NOW(), NOW())",
                    $this->title,
                    $this->detail
                );
        $dbh = new PDO(DSN, USERNAME, PASSWORD);
        $result = $pdo->query($query);
        
        var_dump($result);
        exit;
    }
}


?>
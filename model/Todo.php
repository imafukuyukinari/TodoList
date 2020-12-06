<?php
require_once('./../../config/database.php');

class Todo{
    const STATUS_INCOMPLETE = 0;
    const STATUS_COMPLETE = 1;

    const STATUS_INCOMPLETE_TXT = '未完了';
    const STATUS_COMPLETE_TXT = '完了';

    public $title;
    public $detail;
    public $status;

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getDetail(){
        return $this->detail;
    }

    public function setDetail($detail){
        $this->detail = $detail;
    }
    
    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }


    public static function findByQuery($query){
        $pdo = new PDO(DSN, USERNAME, PASSWORD);
        $stmh = $pdo->query($query);
        if($stmh){
            $todo_list = $stmh->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $todo_list = array();
        }

        if($todo_list && count($todo_list) > 0){
            foreach($todo_list as $index => $todo){
                $todo_list[$index]['display_status'] = self::getDisplayStatus($todo['status']);
            }
        }

        return $todo_list;
    }

    public static function  findAll(){
        $pdo = new PDO(DSN, USERNAME, PASSWORD);
        $stmh = $pdo->query('select * from todos');
        if($stmh){
            $todo_list = $stmh->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $todo_list = array();
        }

        if($todo_list && count($todo_list) > 0){
            foreach($todo_list as $index => $todo){
                $todo_list[$index]['display_status'] = self::getDisplayStatus($todo['status']);
            }
        }

        return $todo_list;
    }

    public static function findById($todo_id){
        $pdo = new PDO(DSN, USERNAME, PASSWORD);
        $stmh = $pdo->query(sprintf('select * from todos where id = %s;', $todo_id));
        if($stmh){
            $todo = $stmh->fetch(PDO::FETCH_ASSOC);
        }else{
            $todo = array();
        }   

        if($todo){
            $todo['display_status'] = self::getDisplayStatus($todo['status']);
        }



        return $todo;
    }

    public static function getDisplayStatus($status){
        if($status == self::STATUS_INCOMPLETE){
            return self::STATUS_INCOMPLETE_TXT;
        }else if($status == self::STATUS_COMPLETE){
            return selfSTATUS_COMPLETE_TXT;
        }
        
        return "";
    }
    
    public function save(){
        $query = sprintf("INSERT INTO `todos` (`title`, `detail`, `status`,
                    `created_at`, `updated_at`)
                VALUES ('%s', '%s', 0, NOW(), NOW())",
                    $this->title,
                    $this->detail
                );

        $pdo = new PDO(DSN, USERNAME, PASSWORD);
        $result = $pdo->query($query);

        return $result;


    }
}

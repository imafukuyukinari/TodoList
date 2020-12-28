<?php
class Todo {
    public $id;
    public $title;
    public $detail;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDetail() {
        return $this->detail;
    }

    public function setDetail($detail) {
        $this->detail = $detail;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public static function findByQuery($query) {
        $dbh = new PDO(DSN, USERNAME, PASSWORD);
        $stmh = $dbh->query($query);

        if($stmh) {
            $result = $stmh->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }

    public static function findAll() {
        $dbh = new PDO(DSN, USERNAME, PASSWORD);
        $query = "SELECT * FROM todos";
        $stmh = $dbh->query($query);
        if($stmh) {
            $result = $stmh->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }

    public static function findById($todo_id) {
        $query = sprintf('SELECT * FROM todos WHERE id = %s', $todo_id);
        $dbh = new PDO(DSN, USERNAME, PASSWORD);
        $stmh = $dbh->query($query);
        if($stmh) {
            $result = $stmh->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }
        return $result;
    }

    public function save() {
        $query = sprintf("INSERT INTO `todos` (`title`, `detail`, `status`, `created_at`, `updated_at`)VALUES ('%s', '%s', 0, NOW(), NOW());", $this->title, $this->detail);

        try {
            $dbh = new PDO(DSN, USERNAME, PASSWORD);

            // トランザクション開始
            $dbh->beginTransaction();

            $stmt = $dbh->prepare($query);
            $result = $stmt->execute();

            $dbh->commit();
        } catch (PDOException $e) {
            // ロールバック
            $dbh->rollBack();

            echo $e->getMessage();
            $result = false;
        }

        return $result;
    }

    public function update() {
        $query = sprintf("UPDATE `todos` SET `title` = %s AND `detail` = %s WHERE `id` = %s", $this->title, $this->detail, $thid->id);

        try {
            $dbh = new PDO(DSN, USERNAME, PASSWORD);

            // トランザクション開始
            $dbh->beginTransaction();

            $stmt = $dbh->prepare($query);
            $result = $stmt->execute();

            $dbh->commit();
        } catch (PDOException $e) {
            // ロールバック
            $dbh->rollBack();

            echo $e->getMessage();
            $result = false;
        }

        return $result;
    }

    public function delete() {
        try {
            $dbh = new PDO(DSN, USERNAME, PASSWORD);
            $dbh->beginTransaction();
            
            $query = sprintf("DELETE FROM `todos` WHERE id = %s", $this->id);
            $stmt = $dbh->prepare($query);
            $result = $stmt->execute();

            $dbh->commit();
        } catch (PDOException $e) {
            $dbh->rollBack();

            echo $e->getMessage();
            $result = false;
        }
        return $result;
    }

    public static function isExistById($todo_id) {
        $dbh = new PDO(DSN, USERNAME, PASSWORD);
        $query = sprintf('SELECT * FROM `todos` WHERE id = %s', $todo_id);
        $stmh = $dbh->query($query);
        if(!$stmh) {
            return false;
        }
        return true;
    }
}

}

<?php
require_once('./../../controller/TodoController.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $controller = new TodoController();
    $controller->new();
    exit;
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規作成</title>
</head>
<body>
    <h1>新規作成</h1>
    <form action="./new.php" method="post">
    <div>
        <div>タイトル</div>
        <input name="title" type="text">
    </div>
    <div>
        <div>詳細</div>
        <textarea name="detail"></textarea>
    </div>
    <button type="submit">登録</button>
    </form>
</body>
</html>
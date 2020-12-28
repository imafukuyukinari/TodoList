<?php
require_once '../../config/database.php';
require_once '../../model/todo.php';
require_once '../../controller/TodoController.php';

$action = new TodoController;
$todo = $action->detail();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>詳細画面</title>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>詳細</th>
                <th>締め切り</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"><?php echo $todo['title']; ?></td>
                <td><?php echo $todo['detail']; ?></td>
                <td><?php echo $todo['deadline_date']; ?></td>
            </tr>
        </tbody>
    </table>
    <div>
        <button><a href="./edit.php">編集</a></button>
    </div>
</body>
</html>

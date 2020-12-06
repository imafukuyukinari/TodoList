<?php
require_once('./../../controller/TodoController.php');

$controller = new TodoController;
$todo = $controller->detail();

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>詳細画面</h1>
<div>
    <div>タイトル</div>
    <div><?php echo $todo['title']; ?></div>
</div>
<div>
    <div>詳細</div>
    <div><?php echo $todo['detail']; ?></div>
</div>
<div>
    <div>ステータス</div>
    <div><?php echo $todo['display_status']; ?></div>
</div>

</body>
</html>

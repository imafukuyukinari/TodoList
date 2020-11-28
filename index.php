<?php

require_once('./../../controller/TodoController.php');

$controller = new TodoController;
$todo_list = Todo::findAll();


?>

<!DOCTYPEhtml>
<htmllang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODOリスト</title>
</head>
<body>
    <div><a href="./new.php">新規作成</a></div>
    <?php if($todo_list):?>
    <ul>
        <?php foreach($todo_list as $todo):?>
            <li><a href="./detail.php?todo_id=<?php echo $todo['id'] ?>"><?php echo $todo['title'];?></a></li>
        <?php endforeach;?>
    </ul>
    </div>
    <?php else:?>
        <div>データなし</div>
    <?php endif;?>
</body>
</html>


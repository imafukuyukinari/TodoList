<?php
require_once('./../../controller/TodoController.php');

// $controller = new TodoController;
// $todo_list = $controller->index();

session_start();
$error_msgs = $_SESSION['error_msgs'];
unset($_SESSION['error_msgs']);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div><a href="./new.php">新規作成</a></div>
    <?php if($todo_list):?>
    <ul>
        <?php foreach($todo_list as $todo):?>
        <li><a href="./detail.php?todo_id=<?php echo $todo['id'] ?>"><?php echo $todo['title'];?></a> : <?php echo $todo['display_status'];?> <button class="delete-btn">削除</button></li>
        <?php endforeach;?>
    </ul>
        <?php else: ?>
            <p>データなし</p>
        <?php endif; ?>

        <?php if($error_msgs):?>
         <div>
            <ul>
                <?php foreach((array)$error_msgs as $error_msg):?>
                    <li><?php echo $error_msg;?></li>
                <?php endforeach;?>
            </ul>
        </div>
    <?endif;?>
    <script src="./../../public/js/jquery-3.5.1.min.js"></script>
    <script>
    $(".delete-btn").click(function() {
        let data = {};
        data.todo_id = 1;

        $.ajax({
            url: './delete.php',
            type: 'post',
            data: data
        }).then(
            function(data){
                let json = JSON.parse(data);
                console.log('success', json);
            },
            function(){
                console.log('fail');
                alert('fail');
            }
        )
    });
    
    </script>
</body>
</html>

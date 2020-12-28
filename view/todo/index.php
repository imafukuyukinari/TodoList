<?php
require_once '../../config/database.php';
require_once '../../model/todo.php';
require_once '../../controller/TodoController.php';

if(isset($_GET['action']) & $_GET['action'] === 'delete') {
    $action = new TodoController;
    $todo_list = $action->delete();
    return;
}

$action = new TodoController;
$todo_list = $action->index();

session_start();
// セッション情報の取得
$error_msgs = $_SESSION['error_msgs'];

//セッション削除
unset($_SESSION["error_msgs"]);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODOリスト</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div>
        <a href="./new.php">新規作成</a>
    </div>
    <div>
        <?php if($todo_list):?>
            <ul>
                <?php foreach($todo_list as $todo):?>
                    <li><a href="./detail.php?todo_id=<?php echo $todo['id'];?>"><?php echo $todo['title'];?></a><button class="delete_btn" data-id="<?php echo $todo['id'];?>">削除</button></li>
                <?php endforeach;?>
            </ul>
        <?php else:?>
            <div>データなし</div>
        <?php endif;?>
    </div>
    <?php if($error_msgs):?>
        <div>
            <ul>
            <?php foreach($error_msgs as $error_msg):?>
                <li><?php echo $error_msg; ?></li>
            <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
</body>
</html>
<script>
$(".delete_btn").on('click', function() {
    // alert($(this).data('id'));
    const todo_id = $(this).data('id');
    window.location.href = "./index.php?action=delete&todo_id=" + todo_id;
});
</script>

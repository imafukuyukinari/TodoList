<?php
require_once('./../../controller/TodoController.php');

$controller = new TodoController;
$result = $controller->delete();


$response = array();
$response['result'] = $result;
echo json_encode($response);

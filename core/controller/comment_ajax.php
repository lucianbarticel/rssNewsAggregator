<?php

require_once('../model/functions_model.php');
session_start();
$user_id = $_SESSION['user'];
$news_id = $_POST['newsid'];
$comment = $_POST['comment'];
add_comment($user_id, $news_id, $comment);
$response = select_comments($news_id);
$resp = array('response' => $response);
echo json_encode($resp);
?>

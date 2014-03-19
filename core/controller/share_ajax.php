<?php

require_once('../model/functions_model.php');
if (isset($_POST['post_id'])) {
    session_start();
    $user = $_SESSION['user'];
    $news_id=$_POST['post_id'];
    share_news($user, $news_id);
    if(check_user_share_news($user, $news_id)) {$response = 'ok'; }
    $resp = array('response' => $response);
    echo json_encode($resp);
}
?>

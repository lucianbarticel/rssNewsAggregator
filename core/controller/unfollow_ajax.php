<?php

require_once('../model/functions_model.php');
session_start();
$logged_id = $_SESSION['user'];
$followed_id = $_POST['user_id'];
unfollow_user($logged_id, $followed_id);
$response = 'ok';
$followers = followers_nr($followed_id);
$resp = array('response' => $response, 'followers' => $followers);
echo json_encode($resp);
?>

<?php

require_once('../model/functions_model.php');
$log_email = $_POST['log_email'];
$log_pass = $_POST['log_pass'];
$user_id = check_login($log_email, $log_pass);
if($user_id == false){
    $response = 'not ok';
} else {
    session_start();
    $_SESSION['logged']='ok';
    $_SESSION['user']=$user_id;
    $response = 'ok';
    $user = $user_id;
}
$resp = array('response' => $response, 'user' =>$user);
echo json_encode($resp);
?>

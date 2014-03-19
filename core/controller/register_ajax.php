<?php

require_once('../model/functions_model.php');
$name = $_POST['reg_name'];
$email = $_POST['reg_email'];
$pass = $_POST['reg_pass'];
$response = register($name, $email, $pass);
$resp = array('response' => $response);
echo json_encode($resp);
?>

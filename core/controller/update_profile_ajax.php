<?php

require_once('../model/functions_model.php');
session_start();
$user_id = $_SESSION['user'];
$name = $_POST['name'];
$age = $_POST['age'];
$location = $_POST['location'];
//$avatar = $_POST['avatar'];
$pass_old = $_POST['pass_old'];
$pass_new = $_POST['pass_new'];

if($pass_old && $pass_old != ""){
    if($pass_old && $pass_new != ""){
        $db_old_pass = select_user($user_id, 'parola');
        $md5_pass_old = md5($pass_old);
        if($db_old_pass == $md5_pass_old){
            $md5_new_pass = md5($pass_new);
            update_user($user_id, 'parola', $md5_new_pass);
            $resp['changed_pass'] = "ok";
        }else{
            $resp['changed_pass'] = "err";
            $resp['alert_pass'] = "Parola veche nu se potriveste cu cea din baza de date. ";
        }
    }
}

if($age && $age != ""){
    if($age > 0){
        update_user($user_id, 'varsta', $age);
        $resp['changed_age'] = "ok";
    }else{
        $resp['changed_age'] = "err";
        $resp['alert_age'] = "Varsta trebuie sa fie mai mare decat 0. ";
    }
}

if($location && $location != ""){
    update_user($user_id, 'locatie', $location);
        $resp['changed_location'] = "ok";
}
if($name && $name != ""){
    update_user($user_id, 'nume', $name);
    $resp['changed_name'] = "ok";
}

echo json_encode($resp);
?>

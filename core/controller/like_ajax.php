<?php

require_once('../model/functions_model.php');
if (isset($_POST['post_id'])) {
    $response = like($_POST['post_id']);
    $resp=array('likes'=>$response);
    echo json_encode($resp);
}
?>

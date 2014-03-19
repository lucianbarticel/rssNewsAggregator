<?php

require_once('../model/functions_model.php');
if ($_POST['search_string'] != "") {
    $response = search($_POST['search_string']);
} else {
    $response = "Nu ai introdus nici un termen de cautat..";
}
$resp = array('response' => $response);
echo json_encode($resp);
?>

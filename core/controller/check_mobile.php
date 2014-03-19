<?php
//verifica daca e mobile sau pc
function is_mobile() {
    if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
        return true;
    } else {
        return false;
    }
}
?>

<?php
//require_once 'core/controller/check_mobile.php';
//require_once 'core/view/header.php';
require_once 'core/model/functions_model.php';
require_once 'core/controller/functions_controller.php';
require_once 'core/view/functions_view.php';
    session_start();
    if (isset($_POST['logout'])) {
        logout();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <script src="js/jquery-1.8.3.js"></script>
        <script src="js/jquery.mobile-1.2.0.js"></script>
        <script type="text/javascript" src="js/modernizr.js"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        
        <script src="js/script.js"></script>
        <link rel="stylesheet" href="css/jquery.mobile-1.2.0.css" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        
        <title>Licenta || Lucian Eduard Barticel</title>
    </head>

    <body>
        <div id="page_container">
            <?php //if(is_mobile()){ include 'view/mobile.php'; } else { include 'view/pc.php'; } ?>
        <?php require_once 'core/view/mobile.php'; ?>
        </div>
    </body>
</html>
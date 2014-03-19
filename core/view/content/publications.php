<?php
include('../../model/functions_model.php');
include('../../controller/functions_controller.php');
?> 
<h1>Publicatii: </h1>
<div id="publics">
    <?php
    $pubs = select_publications();
    foreach ($pubs as $pub) {
        if ($pub['nume'] != "") {
            ?>
            <a id="<?php echo $pub['ID']; ?>" data-role="button" data-theme="c" data-transition="slidedown"><?php echo $pub['nume']; ?></a>
            <?php
        }
    }
    ?>
</div>
<?php
include('../../model/functions_model.php');
include('../../controller/functions_controller.php');
?> 

<h1>Categorii de stiri: </h1>

<form name="news_categories" action="#category" method="post" data-ajax="false">
    <?php
    $categories = select_categories();
    foreach ($categories as $cat) {
        if ($cat['categorie'] != "") {
            ?>
            <a id="<?php echo $cat['categorie']; ?>" data-role="button" data-theme="c" data-transition="slidedown"><?php echo $cat['categorie']; ?></a>
            <?php
        }
    }
    ?>
    <input type="hidden" value="" name="news_cat" id="news_cat" />
</form>
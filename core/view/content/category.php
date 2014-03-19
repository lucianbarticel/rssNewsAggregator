<?php
include('../../model/functions_model.php');
include('../../controller/functions_controller.php');
?> 

<?php
$title = "Categorie";
$category = $_POST['news_cat'];
if ($category != '') {
    $title = $category;
    echo '<h1> Stiri din categoria ' . $title . ': </h1>';
    $the_news = select_category_news($category);
}

?>
<section class="news news_list">
    <?php
    $k = 0;
    foreach ($the_news as $news) {
        ?>
        <article <?php if($k<10 ){ echo 'class="tbshow"'; }?> id="<?php echo $news['ID']; ?>"> 
            <header>
                <h2><?php echo select_news($news['ID'], 'titlu'); ?></h2>
                <h3>Publicatie: <a class="publication" id="<?php echo get_publication($news['ID'], 'ID'); ?>"><?php echo get_publication($news['ID']); ?></a> <span><?php $data = select_news($news['ID'], 'data'); $data = date('d.m.Y', strtotime($data)); echo $data;?></span></h3>
            </header>
            <section class="single_news">
                <section class="news_content">
                    <?php echo the_excerpt(select_news($news['ID'], 'continut')); ?>
                </section>
            </section> 
            <section class="news_footer">
                <a class="like_wrap" id="<?php echo $news; ?>" ><?php echo select_news($news['ID'], 'likes'); ?> </a>
                <?php if (is_loggedin()) { ?>
                    <?php
                    $user_id = $_SESSION['user'];
                    ?>
                    <a class="share_wrap <?php if (check_user_share_news($user_id, $news['ID'])) { ?> inactive_share <?php } else { ?> active_share <?php } ?>">Recomanda</a>
                <?php } ?>
                <a class="read_more_wrap" data-transition="slidedown">Vezi mai mult</a>
            </section>
        </article>
    <?php $k++; } ?>
    <?php if($k >10) { ?><a id="next10" data-role="button" data-theme="b">Urmatoarele zece stiri</a><?php } ?>
</section>
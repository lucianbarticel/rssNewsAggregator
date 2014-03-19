<?php
include('../../model/functions_model.php');
include('../../controller/functions_controller.php');
session_start();
?> 
<?php
$news = $_POST['the_news_id'];
if ($news != "") {
    update_news_views($news);
}
?>
<section class="news" id="<?php echo $news; ?>">
    <article>
        <header>
            <h2><?php echo select_news($news); ?></h2>
            <h3>Publicatie: <?php echo get_publication($news); ?></h3>
        </header>
        <section class="single_news">
            <section class="news_content">
                <?php
                $content = select_news($news, 'continut');
                $content = preg_replace("/<img[^>]+\>/i", "", $content);
                $content = preg_replace("/<a[^>]+\>/i", "", $content);
                echo $content;
                ?>
                <?php
                $guid = select_news($news, 'guid');
                if ($guid && $guid != "") {
                    ?>
                    <h4><a href="<?php echo $guid; ?>" target="_blank">Vezi stirea originala</a></h4>
                    <?php
                }
                ?>

            </section>
            <?php include('comment_template.php'); ?>
            <?php if (is_loggedin()) { ?>
                <section class="who_shared">
                    <?php
                    $users = select_people_who_shared($news);
                    $user_id = $_SESSION['user'];
                    if (empty($users)) {
                        echo '<span class="no_share">Nimeni nu a recomandat aceasta stire</span>';
                    } else {
                        echo 'Utilizatori care au recomandat aceasta stire: ';
                        foreach ($users as $user) {
                            //$the_user_email = select_user($user['ID_utilizator'], 'email');
                            $the_user = select_user($user['ID_utilizator'], 'nume');
                            if ($user_id == $user['ID_utilizator']) {
                                echo '<a href="#myaccount" class="sharing_user" data-transition="slidedown">Eu</a>';
                            } else {
                                echo '<a href="" class="sharing_user other_user" id="' . $user['ID_utilizator'] . '">' . $the_user . '</a>';
                            }
                        }
                    }
                    ?>
                </section>
            <?php } ?>
        </section> 
    </article>
</section>

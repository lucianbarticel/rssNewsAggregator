<?php
include('../../model/functions_model.php');
include('../../controller/functions_controller.php');
?> 
<?php
session_start(); 
$cur_user_id = $_SESSION['user'];
$user_type = $_POST['user_type'];
if ($user_type == "followers") {
    $title = "Urmaritori";
    $users = get_followers($cur_user_id);
    $user_nr = followers_nr($cur_user_id);
    $message = "Nu te urmareste nimeni";
} else if ($user_type == "followed") {
    $title = "Urmariti";
    $users = get_followed($cur_user_id);
    $user_nr = followed_users_nr($cur_user_id);
    $message = "Nu urmaresti pe nimeni";
}
?>
<section class="users">
    <?php
    if ($user_nr > 0) {
        foreach ($users as $user) {
            ?>
            <div class="a_foll_user">
                <span class="name"><?php echo select_user($user, 'nume'); ?></span>
                <a href="" class="foll_user_link" name="foll_user_link" data-transition="slidedown" id="<?php echo $user; ?>" >Vezi profilul</a>
            </div>
        <?php
        }
    } else {
        echo $message;
    }
    ?>
</section>

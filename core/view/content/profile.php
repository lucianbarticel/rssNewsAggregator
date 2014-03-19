<?php
include('../../model/functions_model.php');
include('../../controller/functions_controller.php');
session_start();
?> 
<?php
$user_id = $_POST["the_user_id"];
?>
<div class="full_profile_wrap" id="<?php echo $user_id; ?>">
    <div class="full_profile">
        <div class="profile_pict_wrap">
            <img class="com_avatar" src="images/avatar.jpg" alt="comment_avatar"/>
        </div>
        <div class="profile_details">
            <div class="profile_name_wrap">
                <h3>Nume: <span><?php echo select_user($user_id, 'nume'); ?></span></h3>
            </div>
            <div class="profile_email_wrap">
                <h3>Email: <span><?php echo select_user($user_id); ?></span></h3>
            </div>
            <div class="profile_follows">
                <h3>Persoane urmarite: <a href=""><?php echo followed_users_nr($user_id); ?></a></h3>
            </div>
            <div class="profile_followers">
                <h3>Persoane ce il urmaresc: <a href=""><?php echo followers_nr($user_id); ?></a></h3>
            </div>
        </div>
    </div>
</div>
<?php
$session_user_id = $_SESSION['user'];
if ($session_user_id == $user_id) {
    ?>
    <a href="#edit_profile" data-role="button" data-theme="c" data-transition="slidedown">Editeaza</a>
<?php } else { ?>
    <a id="follow_button" class="<?php
    if (user_is_followed($session_user_id, $user_id)) {
        echo 'unfollow';
    } else {
        echo 'follow';
    }
    ?>" data-role="button" data-theme="c" data-transition="slidedown"><?php
    if (user_is_followed($session_user_id, $user_id)) {
        echo 'Inceteaza sa mai urmaresti';
    } else {
        echo 'Urmareste';
    }
    ?></a>
<?php } ?>
    <a class="view_recommended" id="<?php echo $user_id; ?>" data-role="button" data-theme="c" data-transition="slidedown">Vezi stirile recomandate de <?php if ($session_user_id == $user_id) { echo 'tine'; }else{ echo 'acest utilizator'; }?></a>
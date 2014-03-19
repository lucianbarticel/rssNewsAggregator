<?php
session_start();
$session_user_id = $_SESSION['user'];
?>
<h1>Contul meu</h1>
<!-- <a href="" data-role="button" data-theme="c" data-transition="fade">Publicatiile mele</a> -->
<!-- <a href="" data-role="button" data-theme="c" data-transition="fade">Categoriile mele</a> -->
<form name="follow_form" action="#multi_users" method="post" data-ajax="false">
    <a id="followed" data-role="button" data-theme="c" data-transition="fade">Persoanele pe care le urmaresti</a>
    <a id="followers" data-role="button" data-theme="c" data-transition="fade">Persoanele care te urmaresc</a>
    
    <input type="hidden" value="" name="user_type" id="user_type" />
</form>
<!-- <a href="#edit_profile" data-role="button" data-theme="c" data-transition="fade">Editeaza setarile contului</a> -->
<a id="followed_news" data-role="button" data-theme="c" data-transition="fade">Stirile recomandate de persoanele pe care le urmaresti</a>
<a id="news_by_location" data-role="button" data-theme="c" data-transition="fade">Stirile dupa locatia ta</a>
<button id="<?php echo $session_user_id; ?>" class="submit-view_profile" data-theme="c" data-transition="fade">Vezi profilul</button>
<form name="logout" action="#page1" method="post" data-ajax="false">
    <input type="hidden" name="logout"/>
    <button class="submit-log-out" data-theme="b" data-transition="fade">Delogare</button>
</form>
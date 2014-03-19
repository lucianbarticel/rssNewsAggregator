<?php
include('../../model/functions_model.php');
include('../../controller/functions_controller.php');
session_start();
?> 
<?php
$user_id = $_POST["the_user_id"];
$email = select_user($user_id);
$name = select_user($user_id, 'nume');
$locatie = select_user($user_id, 'locatie');
$varsta = select_user($user_id, 'varsta');
$photo = select_user($user_id, 'photo');
?>
<h1>Editeaza profil</h1>
<form name ="edit_my_profile" id="edit_my_profile" >
    <div class="warn"></div>
    <label for="myname">Nume:</label>
    <input type="text" name="pro_name" id="pro_name" placeholder="<?php echo $name; ?>" />

    <label for="email">Email:</label>
    <input type="text" name="email" value="<?php echo $email; ?>" disabled="disabled" />

    <label for="old_pass">Schimba parola</label>
    <input type="password" name="pro_pass_old" id="pro_pass_old" placeholder="Parola veche" />
    <input type="password" name="pro_pass_new" id="pro_pass_new" placeholder="Parola noua" />
    <input type="password" name="pro_pass_new2" id="pro_pass_new2" placeholder="Confirma parola noua" />

    <label for="age">Varsta</label>
    <input type="text" name="pro_age" id="pro_age" placeholder="<?php
if ($varsta && $varsta != "") {
    echo $varsta;
} else {
    echo 'Varsta ta';
}
?>" />


    <label for="location">Locatie</label>
    <fieldset class="ui-grid-a">
        <div class="ui-block-a">
            <input type="text" name="pro_location" id="pro_location" value="<?php
           if ($locatie && $locatie != "") {
               echo $locatie;
           } else {
               echo 'Locatia ta';
           }
?>" disabled="disabled"/>
        </div>
        <div class="ui-block-b"><a data-role="button" id="get_location" data-theme="b">Preia locatia</a></div>
    </fieldset>


</form>
<a data-role="button" data-theme="b" id="save_profile">Salveaza</a>

<a data-role="button" data-theme="c" data-rel="back">Inapoi</a>
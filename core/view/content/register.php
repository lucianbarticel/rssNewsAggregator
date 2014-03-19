

<section id="register_resp">
    <p id="the_reg_mess"></p>
    <a href="#page1" data-role="button" data-theme="c" data-transition="fade">Intoarce-te la pagina principala</a>
    <a data-role="button" data-theme="c" id="reg_again">Inregistreaza un alt cont</a>
</section>
<section class="reg_form">
    <form name="register" action="" method="post">
        <label for="basic">Utilizator:</label>
        <input type="text" name="register_name" id="register_name" value=""  />
        <label for="basic">Adresa de email:</label>
        <input type="email" name="register_email" id="register_email" value=""  />
        <label for="basic">Parola:</label>
        <input type="password" name="register_password" id="register_password" value=""  />
        <label for="basic">Reintrodu parola:</label>
        <input type="password" name="register_password2" id="register_password2" value=""  />
        <fieldset class="ui-grid-a">
            <div class="ui-block-a"><a data-role="button" data-theme="c" data-rel="back">Inapoi</a> </div>
            <div class="ui-block-b"><button class="submit-register" type="submit" data-theme="b">Trimite</button></div>	   
        </fieldset>
    </form>
</section>
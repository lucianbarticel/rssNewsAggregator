<h1>Autentificare: </h1>
<section id="login_form" class="log-in-cont">
    <div class="warn"></div>
    <form name="login" action="" method="post">
        <label for="basic">Utilizator(email):</label>
        <input type="email" name="log_email" id="log_email" value="" />
        <label for="basic">Parola:</label>
        <input type="password" name="log_password" id="log_pass" value="" />
        <input type="hidden" name="login_form" value="ok" />
        <fieldset class="ui-grid-a">
            <div class="ui-block-a"><button class="submit-log-in" data-theme="b">Trimite</button></div>	 
            <div class="ui-block-b"> <a href="#register" data-role="button" data-theme="c" data-transition="slidedown">Inregistrare</a>  </div>
        </fieldset>
    </form>
    <a data-role="button" data-theme="c" data-rel="back" data-transition="slidedown">Inapoi</a>

</section>
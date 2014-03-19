<form name="news_link" action="#news" method="post" data-ajax="false" >
    <input type="hidden" value="" name="the_news_id" id="the_news_id" />
</form>
<div class="the_footer" data-role="footer" data-position="fixed" data-theme="b">
    <div data-role="controlgroup" data-theme="footer" data-type="horizontal" class="footer_nav">
        <?php if (is_loggedin()) { ?>
            <a id="myaccount" data-role="button" data-theme="footer" data-transition="slidedown">Contul meu</a>
        <?php } else { ?>
            <a id="log-in" data-role="button" data-theme="footer" data-transition="slidedown">Autentificare</a>
        <?php } ?>
        <a id="options" data-role="button" data-theme="footer" data-transition="slidedown">Optiuni</a>
        <a id="categories" data-role="button" data-theme="footer" data-transition="slidedown">Categorii</a>
        <a id="search" data-role="button" data-theme="footer" data-transition="slidedown">Cautare</a>
    </div>
</div> 
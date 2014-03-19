<?php
include('../../model/functions_model.php');
include('../../controller/functions_controller.php');
?> 
<h1>Optiuni de afisare</h1>

<form name="news_options" action="#multi_news" method="post" data-ajax="slidedown">
    <a id="data" data-role="button" data-theme="c" data-transition="slidedown">Cele mai noi stiri</a>
    <a id="views" data-role="button" data-theme="c" data-transition="slidedown">Cele mai citite stiri</a>
    <a id="likes" data-role="button" data-theme="c" data-transition="slidedown">Cele mai apreciate stiri</a>
    <a id="comments" data-role="button" data-theme="c" data-transition="slidedown">Cele mai comentate stiri</a>
    <!-- <a id="relevant" data-role="button" data-theme="c" data-transition="fade">Cele mai relevante stiri</a> -->
    <!-- <a id="archive" data-role="button" data-theme="c" data-transition="fade">Vezi arhiva</a> -->
    <input type="hidden" value="" name="page_opt" id="page_opt" />
</form>
<a id="all_publications" data-role="button" data-theme="b" data-transition="slidedown">Toate publicatiile</a>

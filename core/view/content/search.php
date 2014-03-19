<?php
include('../../model/functions_model.php');
include('../../controller/functions_controller.php');
?> 
<h1>Cautare:</h1>
<form name="search_form" class="search_form" method="post" />
<input type="text" name="search_text" class="search_text" placeholder="Cauta.."/>
</form>
<div class="search_results">

</div>
<form name="search_news_link" action="#news" method="post" data-ajax="false" >
    <input type="hidden" value="" name="the_news_id" id="search_the_news_id" />
</form>
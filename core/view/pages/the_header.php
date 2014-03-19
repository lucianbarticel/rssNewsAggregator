<div data-role="header" data-position="fixed" data-theme="b">
    <a href="#page1" class="ui-btn-left ui-btn ui-btn-icon-notext ui-btn-corner-all ui-shadow ui-btn-up-c" data-transition="slideup" data-iconpos="notext" data-theme="c" data-role="button" data-icon="home" title=" Home ">
        <span class="ui-btn-inner ui-btn-corner-all">
            <span class="ui-btn-text"> Acasa </span> 
            <span data-form="ui-icon" class="ui-icon ui-icon-home ui-icon-shadow"></span>
        </span>     
    </a>
    <h1>What's News</h1>
    <?php if (is_loggedin()) { ?>
    <a id="logout" class="ui-btn-right ui-btn ui-btn-icon-notext ui-btn-corner-all ui-shadow ui-btn-up-c" data-iconpos="notext" data-theme="c" data-role="button" data-icon="delete" title=" Navigation ">
        <span class="ui-btn-inner ui-btn-corner-all">
            <span class="ui-btn-text"> Optiuni </span>
            <span data-form="ui-icon" class="ui-icon ui-icon-delete ui-icon-shadow"></span>
        </span>
    </a>
    <?php } ?>
</div> 
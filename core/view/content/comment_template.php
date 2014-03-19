<?php if (is_loggedin()) { ?>
    <?php //$news = $_GET['the_news_id']; ?>
    <section class="comment_template">
        <div class="comments">
            <?php $the_news = select_comments($news);
            foreach ($the_news as $tnews) { ?>
                <div class="single_comment">
                    <div class="comment_avatar">
                        <img class="com_avatar" src="images/avatar.jpg" alt="comment_avatar"/>
                    </div>
                    <div class="comment_it_is">
                        <div class="comment_meta">
                            <span class="com_user_email" > <?php echo $tnews['email']; ?></span>
                            <span class="com_date"><?php echo $tnews['data']; ?></span>
                        </div>
                        <div class="comment_text">
                            <p><?php echo $tnews['comentariu']; ?></p>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
        <div class="comment_ajax_response"></div>
        <form name="comment_template" action="" method="post">
            <label for="comment_content" id="comment_label">Comentariul tau: </label>
            <textarea id="comment_content" name="comment_content"></textarea>
            <a id="submit_comment" data-role="button" data-theme="b">Trimite comentariu</a>
        </form>
    </section>
<?php } else { ?>
    <span class="not_allowed_comment">Trebuie sa fii autentificat ca sa poti comenta aceasta stire </span>
<?php } ?>
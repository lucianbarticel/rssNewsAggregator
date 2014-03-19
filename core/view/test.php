<?php

$db = new Database();
$the_news = $db->get_most_commented_news();
print_r($the_news);
?>

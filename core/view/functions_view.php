<?php
// afiseaza un array de feed
function display_feed($array_feed, $args) {
    foreach ($array_feed as $k => $cur) {
        foreach ($cur->item as $p => $ctur) {
            foreach ($args as $arg) {
                echo $arg . ' = ' . strip_tags($ctur->$arg) . '<br />';
            }
            echo '<br />';
        }
    }
}

//$feed = 'http://feeds.feedburner.com/bzi?format=xml';
//$feedt = rss_to_array($feed);
//$args = array('title', 'pubDate', 'guid', 'description');
//display_feed($feedt, $args); 
?>

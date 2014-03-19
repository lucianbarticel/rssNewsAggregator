<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully<br />';
mysql_select_db("lucianba_licenta", $con);

function get_rss($tag, $url, $id_pub) {
    $doc = new DOMdocument();
    $doc->load($url);
    foreach ($doc->getElementsByTagName($tag) AS $node) {
        $title = $node->getElementsByTagName('title')->item(0)->nodeValue;
        $link = $node->getElementsByTagName('link')->item(0)->nodeValue;
        $pub_time = $node->getElementsByTagName('pubDate')->item(0)->nodeValue;
        $content = $node->getElementsByTagName('description')->item(0)->nodeValue;
        $content= strip_tags($content, '<br>');
        $tags = array("\n", "\r", "\r\n", "'");
        $content = str_replace($tags, '', $content);
        $content = mysql_real_escape_string($content);
        $category = $node->getElementsByTagName('category')->item(0)->nodeValue;
        $guid = $node->getElementsByTagName('guid')->item(0)->nodeValue;
        $enclosure = $node->getElementsByTagName('enclosure')->item(0)->nodeValue;
        echo $enclosure;
        print_r($enclosure);
        $yesterday = gmdate("D, d M Y H:i:s T", strtotime('-1 days'));
        $my_date = date("Y-m-d H:i:s", strtotime($pub_time));
        $my_yesterday = date("Y-m-d H:i:s", strtotime($yesterday));
        $flag = 0;
        if ($my_date > $my_yesterday) {
            $results = mysql_query("SELECT * FROM stiri");
            while ($row = mysql_fetch_array($results)) {
                if ($row['data'] > $my_yesterday) {
                    if ($guid == $row['guid']) {
                        $flag = 1;
                    };
                }
            }
            if ($flag == 0) {
                if(strlen($content) - strlen($title) > 5){
                $query = "INSERT INTO stiri (ID_publicatie, titlu, continut, data, categorie, guid, link) VALUES (" . $id_pub . ", '" . $title . "', '" . $content . "', '" . $my_date . "', '" . $category . "', '" . $guid . "', '" . $link . "')";
                if (mysql_query($query)) {
                    echo 'Stirea ' . $title . '(' . $pub_time . ') a fost introdusa in baza de date </br>';
                } else {
                    echo mysql_error() . '<br />';
                }
                //echo 'Titlu: ' . $title . '<br /> Continut: ' . $content .'('.strlen($content).')'. '</br>';
                }
            } else {
                echo 'Stirea ' . $title . '(' . $pub_time . ') exista deja </br>';
            }
        }
    }
}

$result = mysql_query("SELECT * FROM publicatii");
while ($row = mysql_fetch_array($result)) {
    echo 'Publicatia curenta este ' . $row['nume'] . '<br />';
    get_rss('item', $row['feed'], $row['ID']);
}

mysql_close($con);
?>

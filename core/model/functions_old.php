<?php



//adauga publicatie

function add_publication($name, $feed, $website = 'http://www.lucianbarticel.ro', $location = 'iasi') {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    if (mysql_query("INSERT INTO publicatii (nume, feed, website, locatie) VALUES ('" . $name . "', '" . $feed . "', '" . $website . "', '" . $location . "')")) {

        echo 'Publication ' . $name . ' has been added with feed = ' . $feed . ', website = ' . $website . ', location = ' . $location . '<br />';
    } else {

        echo mysql_error();
    }

    mysql_close($con);
}

// adauga stire in baza de date

function add_new_news($id_pud, $title, $content, $link) {



    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    $date = date("Y-m-d H:i:s");

    $query = "INSERT INTO stiri (ID_publicatie, titlu, continut, data, link) VALUES ('" . $id_pud . "', '" . $title . "', '" . $content . "', '" . $date . "', '" . $link . "')";

    if (mysql_query($query)) {

        return true;
    } else {

        echo mysql_error();

        return false;
    }

    mysql_close($con);
}

//adauga categorie

function add_new_category($name) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    $results = mysql_query("SELECT * FROM categorii WHERE nume = '" . $name . "'");

    $row = mysql_fetch_array($results);

    if (empty($row)) {

//echo 'categoria nu exista asa ca va fi inserata<br/>';

        if (mysql_query("INSERT INTO categorii (nume) VALUES ('" . $name . "')")) {

//echo 'Category: ' . $name . ' has been added <br />';

            $result = mysql_query("SELECT ID FROM categorii Order By ID DESC limit 1");

            while ($row = mysql_fetch_array($result)) {

                return $row['ID'];
            }
        } else {

            echo mysql_error();

            $result = mysql_query("SELECT ID FROM categorii WHERE nume ='" . $name . "'");

            while ($row = mysql_fetch_array($result)) {

                return $row['ID'];
            }
        }
    } else {

//echo 'categorie deja existenta';



        return false;
    }

    mysql_close($con);
}

//assign news to category

function add_news_to_cat($id_news, $cat_id) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);



    if (mysql_query("INSERT INTO categorii_stiri (ID_categorie, ID_stire) VALUES (" . $cat_id . ", " . $id_news . ")")) {

        echo 'Success <br />';

        return true;
    } else {

        echo mysql_error();

        return false;
    }



    mysql_close($con);
}

///de verificat urmatoarea functie

function add_news($id_pud, $title, $content, $date, $link, $since = null, $cat = null) {

    $id_news = add_new_news($id_pud, $title, $content, $date, $link, $since);

    if ($cat) {

        $cat_id = add_new_category($cat);

        add_news_to_cat($id_news, $cat_id);
    }

    echo mysql_error();
}

//get last 24h news id's
//get title 

function get_the_title($id = null) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    if ($id) {

        $result = mysql_query("SELECT titlu FROM stiri WHERE ID =" . $id);

        while ($row = mysql_fetch_array($result)) {

            return $row['titlu'];
        }
    }

    echo mysql_error();

    mysql_close($con);
}

function get_the_content($id = null) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    if ($id) {

        $result = mysql_query("SELECT continut FROM stiri WHERE ID =" . $id);

        while ($row = mysql_fetch_array($result)) {

            return $row['continut'];
        }
    }

    echo mysql_error();

    mysql_close($con);
}

function get_the_date($id = null) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    if ($id) {

        $result = mysql_query("SELECT data FROM stiri WHERE ID =" . $id);

        while ($row = mysql_fetch_array($result)) {

            return $row['data'];
        }
    }

    echo mysql_error();

    mysql_close($con);
}

function get_the_link($id = null) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    if ($id) {

        $result = mysql_query("SELECT link FROM stiri WHERE ID =" . $id);

        while ($row = mysql_fetch_array($result)) {

            return $row['link'];
        }
    }

    echo mysql_error();

    mysql_close($con);
}

function get_the_likes($id = null) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    if ($id) {

        $result = mysql_query("SELECT likes FROM stiri WHERE ID =" . $id);

        while ($row = mysql_fetch_array($result)) {

            return $row['likes'];
        }
    }

    echo mysql_error();

    mysql_close($con);
}

function get_latest_news() {

    $yday = date('Y-m-d h:i:s', strtotime("-1 day"));

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    $result = mysql_query("SELECT * FROM stiri");

    $latest_news = array();

    while ($row = mysql_fetch_array($result)) {

        if ($row['data'] > $yday) {

            array_unshift($latest_news, $row['ID']);
        }
    }

    echo mysql_error();

    return $latest_news;

    mysql_close($con);
}

function get_the_news($nr = null) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    $result = mysql_query("SELECT * FROM stiri");

    $the_news = array();

    while ($row = mysql_fetch_array($result)) {

        array_unshift($the_news, $row['ID']);
    }

    echo mysql_error();

    return $the_news;

    mysql_close($con);
}

function get_most_liked_news($nr = null) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    $result = mysql_query("SELECT * FROM stiri WHERE likes <> 0 ORDER BY likes ASC ");

    $the_news = array();

    while ($row = mysql_fetch_array($result)) {

        array_unshift($the_news, $row['ID']);
    }

    echo mysql_error();

    return $the_news;

    mysql_close($con);
}

function get_most_commented_news($nr = null) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    $result = mysql_query("SELECT * FROM stiri WHERE comments <> 0 ORDER BY comments ASC ");

    $the_news = array();

    while ($row = mysql_fetch_array($result)) {

        array_unshift($the_news, $row['ID']);
    }

    echo mysql_error();

    return $the_news;

    mysql_close($con);
}

function get_most_viewed_news($nr = null) {

    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');

    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("lucianba_licenta", $con);

    $result = mysql_query("SELECT * FROM stiri WHERE views <> 0 ORDER BY views ASC ");

    $the_news = array();

    while ($row = mysql_fetch_array($result)) {

        array_unshift($the_news, $row['ID']);
    }

    echo mysql_error();

    return $the_news;

    mysql_close($con);
}

function like($id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $result = mysql_query("SELECT likes FROM stiri WHERE ID=" . $id);
    while ($row = mysql_fetch_array($result)) {
        $likes = $row['likes'];
    }
    $likes++;
    if (mysql_query("UPDATE stiri SET likes=" . $likes . " WHERE ID=" . $id)) {
        return $likes;
    } else {
        return mysql_error();
    }
    mysql_close($con);
}

function register($reg_name, $reg_email, $reg_pass) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $emails = array();
    $pass = md5($reg_pass);
    $result = mysql_query("SELECT email FROM utilizatori");
    while ($row = mysql_fetch_array($result)) {
        array_push($emails, $row["email"]);
    }
    if (in_array($reg_email, $emails)) {
        return "Exista deja un utilizator cu aceasta adresa de email";
    } else {
        $query = "INSERT INTO utilizatori (nume, email, parola) VALUES ('" . $reg_name . "', '" . $reg_email . "', '" . $pass . "')";
        if (mysql_query($query)) {
            return "Utilizatorul " . $reg_name . " a fost inregistrat";
        } else {
            return mysql_error();
        }
    }

    mysql_close($con);
}

function check_login($log_email, $log_pass) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $pass = md5($log_pass);
    $result = mysql_query("SELECT * FROM utilizatori WHERE email='" . $log_email . "' AND parola='" . $pass . "'");
    if (mysql_num_rows($result) < 1) {
        return false;
    } else {
        return true;
    }
    mysql_close($con);
}

function get_user_id($email) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $result = mysql_query("SELECT * FROM utilizatori WHERE email='" . $email . "'");
    while ($row = mysql_fetch_array($result)) {
        return $row['ID'];
    }
    mysql_close($con);
}

function get_user_email($id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $result = mysql_query("SELECT * FROM utilizatori WHERE ID='" . $id . "'");
    while ($row = mysql_fetch_array($result)) {
        return $row['email'];
    }
    mysql_close($con);
}

function get_user_name($id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $result = mysql_query("SELECT * FROM utilizatori WHERE ID='" . $id . "'");
    while ($row = mysql_fetch_array($result)) {
        return $row['nume'];
    }
    mysql_close($con);
}

function add_comment($user_id, $news_id, $comment) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $result = mysql_query("SELECT comments FROM stiri WHERE ID=" . $news_id);
    while ($row = mysql_fetch_array($result)) {
        $comment_nr = $row['comments'];
    }
    $comment_nr++;
    $query1 = "INSERT INTO comentarii (ID_utilizator, ID_stire, comentariu, data) VALUES (" . $user_id . ", " . $news_id . ", '" . $comment . "', NOW())";
    $query2 = "UPDATE stiri SET comments=" . $comment_nr . " WHERE ID=" . $news_id;
    if (mysql_query($query1)) {
        if (mysql_query($query2)) {
            return true;
        } else {
            return 'problema la query2';
        }
    } else {
        return 'problema la query1';
    }
    mysql_close($con);
}

function get_comment_of_news($news_id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $comments = array();
    $comment = array();
    $result = mysql_query("SELECT * FROM comentarii WHERE ID_stire='" . $news_id . "'");
    while ($row = mysql_fetch_array($result)) {
        $comment['user_name'] = get_user_name($row['ID_utilizator']);
        $comment['comment_content'] = $row['comentariu'];
        $comment['comment_date'] = $row['data'];
        array_push($comments, $comment);
    }
    return $comments;
    mysql_close($con);
}

function search($search_string) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $news = array();
    $one_news = array();
    $result = mysql_query("SELECT * FROM stiri WHERE titlu LIKE '%" . $search_string . "%'");
    while ($row = mysql_fetch_array($result)) {
        $one_news['news_id'] = $row['ID'];
        $one_news['news_title'] = $row['titlu'];
        array_push($news, $one_news);
    }
    return $news;
    mysql_close($con);
}

function get_categories() {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $categories = array();
    $query = "SELECT DISTINCT categorie FROM stiri";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        array_unshift($categories, $row['categorie']);
    }
    return $categories;
    die();
    mysql_close($con);
}

function get_news_from_cat($category) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $result = mysql_query("SELECT * FROM stiri WHERE categorie='" . $category . "'");

    $category_news = array();

    while ($row = mysql_fetch_array($result)) {
        array_unshift($category_news, $row['ID']);
    }
    return $category_news;
    mysql_close($con);
}

function add_view($news) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $result = mysql_query("SELECT views FROM stiri WHERE ID='" . $news . "'");
    while ($row = mysql_fetch_array($result)) {
        $views_nr = $row['views'];
    }
    $views_nr++;
    $query = "UPDATE stiri SET views=" . $views_nr . " WHERE ID=" . $news;
    if (mysql_query($query)) {
        return true;
    } else {
        return false;
    }
    mysql_close($con);
}

function share_news($user_id, $news_id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $query = "INSERT INTO meta_utilizatori (ID_utilizator, cheie, valoare) VALUES (" . $user_id . ", 'share', '" . $news_id . "')";
    if (mysql_query($query)) {
        return 'ok';
    } else {
        return mysql_error();
    }
    mysql_close($con);
}

function news_shared($user_id, $news_id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $query = "SELECT * FROM meta_utilizatori WHERE ID_utilizator = " . $user_id . " AND cheie = 'share' AND valoare = '" . $news_id . "'";
    $result = mysql_query($query);
    if (mysql_num_rows($result) < 1) {
        return false;
    } else {
        return true;
    }
    mysql_close($con);
}

function people_who_shared($news_id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $users = array();
    $query = "SELECT * FROM meta_utilizatori WHERE cheie = 'share' AND valoare = '" . $news_id . "'";
    $result = mysql_query($query);
    if (mysql_num_rows($result) >= 1) {
        while ($row = mysql_fetch_array($result)) {
            array_unshift($users, $row['ID_utilizator']);
        }
        return $users;
    } else {
        return 'none';
    }
    mysql_close($con);
}

function follow_user($current_user, $followed_user) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $query = "INSERT INTO relatii_utilizatori (ID_utilizator1, ID_utilizator2) VALUES (" . $current_user . ", " . $followed_user . ")";
    if (mysql_query($query)) {
        return true;
    } else {
        return false;
    }
    mysql_close($con);
}

function unfollow_user($current_user, $followed_user) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $query = "DELETE FROM relatii_utilizatori WHERE ID_utilizator1 = " . $current_user . " AND ID_utilizator2 = " . $followed_user;
    if (mysql_query($query)) {
        return true;
    } else {
        return false;
    }
    mysql_close($con);
}

function user_is_followed($current_user, $followed_user) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $query = "SELECT * FROM relatii_utilizatori WHERE ID_utilizator1 = " . $current_user . " AND ID_utilizator2 = " . $followed_user;
    $result = mysql_query($query);
    if (mysql_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
    mysql_close($con);
}

function followed_users_nr($user_id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $query = "SELECT * FROM relatii_utilizatori WHERE ID_utilizator1 = " . $user_id;
    $result = mysql_query($query);
    $number = mysql_num_rows($result);
    return $number;
    mysql_close($con);
}

function followers_nr($user_id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $query = "SELECT * FROM relatii_utilizatori WHERE ID_utilizator2 = " . $user_id;
    $result = mysql_query($query);
    $number = mysql_num_rows($result);
    return $number;
    mysql_close($con);
}

function get_followers($user_id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $the_users = array();
    $query = "SELECT * FROM relatii_utilizatori WHERE ID_utilizator2 = " . $user_id;
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        array_unshift($the_users, $row['ID_utilizator1']);
    }
    return $the_users;
    mysql_close($con);
}

function get_followed($user_id) {
    $con = mysql_connect('localhost', 'lucianba', 'ofybLXXiNb');
    if (!$con) {

        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("lucianba_licenta", $con);
    $the_users = array();
    $query = "SELECT * FROM relatii_utilizatori WHERE ID_utilizator1 = " . $user_id;
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        array_unshift($the_users, $row['ID_utilizator2']);
    }
    return $the_users;
    mysql_close($con);
}

?>

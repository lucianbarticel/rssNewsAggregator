<?php

include('ClassDatabase.php');

///Selects
function select_news($id, $part = "titlu") {
    $db = new Database();
    $sql = "SELECT $part FROM stiri WHERE ID = $id";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result[0][$part];
}

function select_publication($id, $part = "nume") {
    $db = new Database();
    $sql = "SELECT $part FROM publicatii WHERE ID = $id";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result[0][$part];
}

function select_user($id, $part = "email") {
    $db = new Database();
    $sql = "SELECT $part FROM utilizatori WHERE ID = $id";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result[0][$part];
}

function select_news_by($option = 'comments') {
    $db = new Database();
    $sql = "SELECT ID FROM stiri ORDER BY $option DESC";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result;
}

function select_people_who_shared($news_id) {
    $db = new Database();
    $sql = "SELECT ID_utilizator FROM meta_utilizatori WHERE cheie = 'share' AND valoare = '" . $news_id . "'";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result;
}

function select_comments($news_id) {
    $db = new Database();
    $sql = "SELECT * FROM comentarii WHERE ID_stire='" . $news_id . "'";
    $db->query($sql);
    $results = $db->fetchRecord(1);
    $comments = array();
    foreach ($results as $result) {
        $comment['email'] = select_user($result['ID_utilizator'], 'email');
        $comment['data'] = $result['data'];
        $comment['comentariu'] = $result['comentariu'];
        array_push($comments, $comment);
    }
    return $comments;
}

function select_categories() {
    $db = new Database();
    $sql = "SELECT DISTINCT categorie FROM stiri";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result;
}

function select_publications(){
    $db = new Database();
    $sql = "SELECT * FROM publicatii";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result;
}

function select_category_news($category) {
    $db = new Database();
    $sql = "SELECT * FROM stiri WHERE categorie='" . $category . "'";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result;
}

function select_all_emails() {
    $db = new Database();
    $sql = "SELECT email FROM utilizatori";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result;
}

function select_recommended_news($user_id) {
    $db = new Database();
    //$sql = "SELECT stiri.ID FROM stiri LEFT JOIN meta_utilizatori ON meta_utilizatori.valoare = stiri.ID AND meta_utilizatori.ID_utilizator = $user_id AND meta_utilizatori.cheie = 'share'";
    $sql = "SELECT stiri.ID FROM stiri, meta_utilizatori WHERE stiri.ID = meta_utilizatori.valoare AND meta_utilizatori.ID_utilizator = $user_id AND meta_utilizatori.cheie = 'share'";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result;
}

function get_news_by_location($location) {
    $db = new Database();
    //$sql = "SELECT stiri.ID FROM stiri LEFT JOIN meta_utilizatori ON meta_utilizatori.valoare = stiri.ID AND meta_utilizatori.ID_utilizator = $user_id AND meta_utilizatori.cheie = 'share'";
    $sql = "SELECT stiri.ID FROM stiri, publicatii WHERE stiri.ID_publicatie = publicatii.ID AND UPPER(publicatii.locatie) = UPPER('$location') ORDER BY stiri.likes DESC";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result;
}

function select_fol_recommended_news($user_id) {
    $db = new Database();
    $followed = get_followed($user_id);
    $news = array();
    foreach ($followed as $fol) {
        $sql = "SELECT stiri.ID FROM stiri, meta_utilizatori WHERE stiri.ID = meta_utilizatori.valoare AND meta_utilizatori.ID_utilizator = $fol AND meta_utilizatori.cheie = 'share'";
        $db->query($sql);
        $results = $db->fetchRecord(1);
        foreach ($results as $result) {
            if(!in_array($result, $news) ){
                array_unshift($news, $result);
            }
        }
    }
    //$sql = "SELECT stiri.ID FROM stiri LEFT JOIN meta_utilizatori ON meta_utilizatori.valoare = stiri.ID AND meta_utilizatori.ID_utilizator = $user_id AND meta_utilizatori.cheie = 'share'";
    return $news;
}

function get_publication($news_id, $part='nume'){
    $db = new Database();
    $sql = "SELECT publicatii.nume, publicatii.ID FROM publicatii, stiri WHERE stiri.ID = $news_id AND publicatii.ID = stiri.ID_publicatie";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    $result = $result[0][$part];
    return $result;
}

function select_news_by_publication($pub){
    $db = new Database();
    $sql = "SELECT ID FROM stiri WHERE ID_publicatie = $pub ORDER BY data DESC";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    return $result;
}

///Inserts
function insert_publication($name, $feed, $website = 'http://www.lucianbarticel.ro', $location = 'iasi') {
    $db = new Database();
    $sql = "INSERT INTO publicatii (nume, feed, website, locatie) VALUES ('$name', '$feed', '$website', '$location')";
    $db->query($sql);
    $response = "Publication ' . $name . ' has been added with feed = ' . $feed . ', website = ' . $website . ', location = ' . $location . '<br />";
    echo $response;
}

function insert_news($id_pud, $title, $content, $link) {
    $db = new Database();
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO stiri (ID_publicatie, titlu, continut, data, link) VALUES ('" . $id_pud . "', '" . $title . "', '" . $content . "', '" . $date . "', '" . $link . "')";
    $db->query($sql);
}

function check_login($log_email, $log_pass) {
    $db = new Database();
    $pass = md5($log_pass);
    $sql = "SELECT * FROM utilizatori WHERE email='" . $log_email . "' AND parola='" . $pass . "'";
    $db->query($sql);
    $result = $db->fetchRecord(1);
    if ($db->numRows() < 1) {
        return false;
    } else {
        return $result[0]['ID'];
    }
}

function check_user_share_news($user_id, $news_id) {
    $db = new Database();
    $sql = "SELECT * FROM meta_utilizatori WHERE ID_utilizator = " . $user_id . " AND cheie = 'share' AND valoare = '" . $news_id . "'";
    $db->query($sql);
    $nr_results = $db->numRows();
    if ($nr_results < 1) {
        return false;
    } else {
        return true;
    }
}

function update_news_views($news) {
    $views = select_news($news, 'views');
    $views_nr = $views + 1;
    $db = new Database();
    $sql = "UPDATE stiri SET views=" . $views_nr . " WHERE ID=" . $news;
    $db->query($sql);
}

function update_user($user_id, $part, $value) {
    $db = new Database();
    $sql = "UPDATE utilizatori SET " . $part . "='" . $value . "' WHERE ID=" . $user_id;
    $db->query($sql);
}

function update_news_comments($news) {
    $comments = select_news($news, 'comments');
    $comments_nr = $comments + 1;
    $db = new Database();
    $sql = "UPDATE stiri SET views=" . $comments_nr . " WHERE ID=" . $news;
    $db->query($sql);
}

function like($id) {
    $db = new Database();
    $likes = select_news($id, 'likes');
    $likes_nr = $likes + 1;
    $sql = "UPDATE stiri SET likes=" . $likes_nr . " WHERE ID=" . $id;
    $db->query($sql);
    return $likes_nr;
}

function share_news($user_id, $news_id) {
    $db = new Database();
    $sql = "INSERT INTO meta_utilizatori (ID_utilizator, cheie, valoare) VALUES (" . $user_id . ", 'share', '" . $news_id . "')";
    $db->query($sql);
}

function add_comment($user_id, $news_id, $comment) {
    $db = new Database();
    $sql = "INSERT INTO comentarii (ID_utilizator, ID_stire, comentariu, data) VALUES (" . $user_id . ", " . $news_id . ", '" . $comment . "', NOW())";
    $db->query($sql);
    update_news_comments($news_id);
}

function search($search_string) {
    $db = new Database();
    $sql = "SELECT * FROM stiri WHERE titlu LIKE '%" . $search_string . "%'";
    $db->query($sql);
    $results = $db->fetchRecord(1);
    $news = array();
    foreach ($results as $result) {
        $one_news['news_id'] = $result['ID'];
        $one_news['news_title'] = $result['titlu'];
        array_push($news, $one_news);
    }
    return $news;
}

function register($reg_name, $reg_email, $reg_pass) {
    $emails = select_all_emails();
    $temails = array();
    foreach ($emails as $email) {
        array_push($temails, $email['email']);
    }
    $pass = md5($reg_pass);
    if (in_array($reg_email, $temails)) {
        return "Exista deja un utilizator cu aceasta adresa de email";
    }
    $db = new Database();
    $sql = "INSERT INTO utilizatori (nume, email, parola) VALUES ('" . $reg_name . "', '" . $reg_email . "', '" . $pass . "')";
    $db->query($sql);
    return "Utilizatorul " . $reg_name . " a fost inregistrat";
}

function followed_users_nr($user_id) {
    $db = new Database();
    $sql = "SELECT * FROM relatii_utilizatori WHERE ID_utilizator1 = " . $user_id;
    $db->query($sql);
    $number = $db->numRows();
    return $number;
}

function followers_nr($user_id) {
    $db = new Database();
    $sql = "SELECT * FROM relatii_utilizatori WHERE ID_utilizator2 = " . $user_id;
    $db->query($sql);
    $number = $db->numRows();
    return $number;
}

function user_is_followed($current_user, $followed_user) {
    $db = new Database();
    $sql = "SELECT * FROM relatii_utilizatori WHERE ID_utilizator1 = " . $current_user . " AND ID_utilizator2 = " . $followed_user;
    $db->query($sql);
    $nr_results = $db->numRows();
    if ($nr_results < 1) {
        return false;
    } else {
        return true;
    }
}

function follow_user($current_user, $followed_user) {
    $db = new Database();
    $sql = "INSERT INTO relatii_utilizatori (ID_utilizator1, ID_utilizator2) VALUES (" . $current_user . ", " . $followed_user . ")";
    $db->query($sql);
}

function unfollow_user($current_user, $followed_user) {
    $db = new Database();
    $sql = "DELETE FROM relatii_utilizatori WHERE ID_utilizator1 = " . $current_user . " AND ID_utilizator2 = " . $followed_user;
    $db->query($sql);
}

function get_followers($user_id) {
    $db = new Database();
    $sql = "SELECT * FROM relatii_utilizatori WHERE ID_utilizator2 = " . $user_id;
    $db->query($sql);
    $results = $db->fetchRecord(1);
    $users = array();
    foreach ($results as $result) {
        array_unshift($users, $result['ID_utilizator1']);
    }
    return $users;
}

function get_followed($user_id) {
    $db = new Database();
    $sql = "SELECT * FROM relatii_utilizatori WHERE ID_utilizator1 = " . $user_id;
    $db->query($sql);
    $results = $db->fetchRecord(1);
    $users = array();
    foreach ($results as $result) {
        array_unshift($users, $result['ID_utilizator2']);
    }
    return $users;
}

?>
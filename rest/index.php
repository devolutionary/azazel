<?php

error_reporting(-1);
ini_set('error_reporting', E_ALL);

define ('CLASS_PATH', '../classes/');

require '../classes/database.class.php';

$db = new Database();

$post = json_decode(file_get_contents("php://input"), true);
$post = $_GET;

if (isset($post['controller'])) {
    call_user_func($post['controller']."Controller", $post);
}

function articleController($post) {
    if (!isset($post['action'])) return false;

    $url = isset($post['url'])?$post['url']:false;
    $offset = isset($post['offset'])?$post['offset']:0;
    $tag = isset($post['tag'])?$post['tag']:false;

    switch($post['action']) {
        case 'all':
            return getArticlesByOffset($offset);
            break;
        case 'tag':
            return getArticlesByTag($tag, $offset);
    }


    function getArticlesByOffset($offset) {
        $db = new Database();
        $query = 'select * from articles limit 10 offset '.$offset;
        $db->query($query, false);
        $articles = array();

        foreach ($db->getArray() as $k => $v) {
            $v['tags'] = getTagsForArticle($v['articleID']);
            $articles[$v['articleID']] = $v;
        }
        return json_encode($articles);
    }

    function getArticlesByTag($tag, $offset) {
        if (!$tag) return false;

        $db = new Database();
        $query = 'select * from articles natural join article_has_tag natural join tags where tagName=:tagname limit 10 offset '.$offset;
        $db->query($query, array(':tagname' => $tag));
        return json_encode($db->getArray());
    }

    function getArticleByUrl($url) {

    }

    function getTagsForArticle($id) {
        $db = new Database();
        $query = 'select tagName from article_has_tag where articleID=:id';
        if ($db->query($query, array(':id' => $id)) > 0)
            return $db->getArray();
        return array();
    }
}

/*
if (isset($_GET['populate'])) {
    for ($i = 0; $i < 25; $i++) {
        $params = array(
            ':url' => generateRandomString(16),
            ':title' => generateRandomString(32),
            ':subtext' => generateRandomString(64),
            ':content' => generateRandomString(256),
            ':datetime' => mktime() - (mt_rand(60*10,60*60*24*7))
        );
        print_r($params);

        $db->query('insert into articles (url, title, subtext, content, datetime) values (:url, :title, :subtext, :content, :datetime)', $params);
    }
}


function generateRandomString($n) {
    $char = 'abcdeghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $rand = mt_rand(0, strlen($char) - 1);
        $str .= substr($char, $rand, 1);
    }
    return $str;
}
*/
?>


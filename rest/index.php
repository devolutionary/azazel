<?php

error_reporting(-1);
ini_set('error_reporting', E_ALL);

define ('CLASS_PATH', '../classes/');

require '../classes/database.class.php';

$db = new Database();

$post = json_decode(file_get_contents("php://input"), true);


if (isset($post['controller'])) {
    call_user_func($post['controller']."Controller", $post);
    print_r($post);
}


function articleController($post) {

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


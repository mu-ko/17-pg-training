<?php
require_once 'functions.php';
// ログインページ

session_start();

$login_name = htmlspecialchars($_POST['login_name']);

$database = getDatabase();

$sql_check ="
    SELECT *
    FROM `user`
    WHERE `login_name` = ?
";
$sth = $database->prepare($sql_check);
$sth->setFetchMode(PDO::FETCH_ASSOC);
$sth->execute([$login_name]);
$user =$sth->fetch();

if ($user === false) {
    // ログイン失敗
    header('Location: /login.php');
} else {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_login_name'] = $user['login_name'];
    $_SESSION['user_display_name'] = $user['display_name'];
    header('Location: /');
}

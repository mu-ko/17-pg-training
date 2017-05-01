<?php
require_once 'functions.php';
// トゥート投稿

session_start();
redirectToLoginPageIfNotLoggedIn();


$toot_text = $_POST['text'];

$database = getDatabase();
$created_at = date('Y-m-d H:i:s');
$sql="INSERT INTO `toot`(`user_id`, `text`, `image_file_name`,`created_at`) VALUES ({$_SESSION['user_id']},'{$toot_text}','','{$created_at}')";
$database->query($sql);


header('Location: /');

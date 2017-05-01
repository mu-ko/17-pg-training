<?php
require_once 'functions.php';
// トゥート投稿

session_start();
redirectToLoginPageIfNotLoggedIn();


$toot_text = $_POST['text'];

$uploaddir = getcwd().'/uploaded_image/';
$uploadfile = $uploaddir . basename($_FILES['image']['name']);

move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

$database = getDatabase();
$created_at = date('Y-m-d H:i:s');
$sql="INSERT INTO `toot`(`user_id`, `text`, `image_file_name`,`created_at`) VALUES ({$_SESSION['user_id']},'{$toot_text}','{$_FILES['image']['name']}','{$created_at}')";
$database->query($sql);





header('Location: /');

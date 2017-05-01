<?php
require_once 'functions.php';
// トゥート投稿

session_start();
redirectToLoginPageIfNotLoggedIn();


$toot_text = htmlspecialchars($_POST['text']);

if($_FILES['image']['name']!=''){
  $newfilename = date("YmdHis")."-".$_SESSION['user_id']."-" .$_SESSION['user_login_name'];
  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);


$uploaddir = getcwd().'/uploaded_image/';
$uploadfile = $uploaddir . $newfilename . ".".$ext;
$uploadfile_name =  $newfilename . ".".$ext;

move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
}else{
  $uploadfile_name = "";
}


$database = getDatabase();
$created_at = date('Y-m-d H:i:s');

$sql="INSERT INTO `toot`(`user_id`, `text`, `image_file_name`,`created_at`) VALUES (?,?,?,?)";
$sth = $database->prepare($sql);
$res = $sth->execute([$_SESSION['user_id'],
$toot_text,
$uploadfile_name,
$created_at]);



header('Location: /');

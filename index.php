<?php
// トップページ
require_once 'functions.php';

session_start();
redirectToLoginPageIfNotLoggedIn();

$user_login_name = $_SESSION['user_login_name'];


$database = getDatabase();
$toots=$database->query("SELECT `id`, `user_id`, `text`, `image_file_name`, `created_at` FROM `toot` ORDER BY `id` DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- 下にindex.htmlをコピペして、index.htmlを消そう！ -->
<html>
    <head>
        <title>Yastodon(ヤストドン)</title>
        <link rel="stylesheet" href="/css/style.css">
        <meta charset="utf-8">
    </head>
    <body>
        <div class="wrapper">
            <div class="container myself-container">
                <div class="myself">
                    <div class="user-icon"></div>
                    <div class="user-name"></div>
                </div>
                <form enctype="multipart/form-data" method="post" action="/post_toot.php">
                    <textarea name="text" placeholder="今なにしてる？" required></textarea>
                    <input type="file" name="image">
                    <div class="toot-button-container">
                        <input type="submit" class="toot-button" value="トゥート!">
                    </div>
                </form>
            </div>

            <div class="container toot-container">
                <div class="label icon-home"><img class="label-icon" src="/img/home.png" width="15" alt="Home - ">ホーム</div>
                <ul>
                  <?php
                  foreach ($toots as $toot) {
                    ?>

                    <li>
                      <img width="30" src="img/home.png" alt="">
                      <div>
                        <div class="name-id">
                          <div><?php $tootUserInfo = $database->query
                          ("SELECT `display_name` ,`login_name` FROM `user` WHERE `id`=" .$toot['user_id'])->fetch(PDO::FETCH_ASSOC);
                          echo $tootUserInfo['display_name'];
                           ?>
                          </div>
                          <div class="login-name"><?php echo "@" .$tootUserInfo['login_name']; ?></div>
                        </div>
                        <p><?php echo $toot['text']; ?></p>
                      </div>
                      <?php if($toot['image_file_name']!=""){?>
                      <div><img src="uploaded_image/<?php echo $toot['image_file_name']?>" alt=""></div>
                      <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="container about-container">
                <div class="label icon-asterisk"><img class="label-icon" src="/img/asterisk.png" width="15" alt="Start - ">スタート</div>
                <div class="contents">
                    <p>
                        Yastodonとは研修のために作られた教育用ソーシャル・ネットワーキング・サービスです。<br>
                        あなただけの素敵なサービスをここから成長させていってください。
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>

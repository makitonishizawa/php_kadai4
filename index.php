<?php
session_start();

require_once('user_funcs.php');
$pdo = db_con();

$userID = $_SESSION['chk_ssid'];
$sessionID = session_ID();
$kanriFlg = $_SESSION['kanri']
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>main menu</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <?php if ($kanriFlg == 1): ?>
                    <div class="navbar-header"><a class="navbar-brand" href="user_select.php">ユーザー一覧</a></div>
                <?php endif; ?>
                <div class="navbar-header"><a class="navbar-brand" href="bm_select.php">ブックマーク一覧</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
                
            </div>
        </nav>
    </header>

        


    <!-- Head[End] -->

    <!-- Main[Start] -->
    <!-- <form method="POST" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>フリーアンケート</legend>
                <label>名前：<input type="text" name="name"></label><br>
                <label>Email：<input type="text" name="email"></label><br>
                <label>年齢：<input type="text" name="age"></label><br>
                <label><textArea name="naiyou" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form> -->
    <!-- Main[End] -->
</body>

</html>

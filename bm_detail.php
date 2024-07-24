<?php
//funcs.phpの中の関数を呼び出し
require_once('user_funcs.php');

/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
 */

$id = $_GET['id'];

// try {
//     $db_name = 'gs_db_class3';    //データベース名
//     $db_id   = 'root';      //アカウント名
//     $db_pw   = '';      //パスワード：MAMPは'root'
//     $db_host = 'localhost'; //DBホスト
//     $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
// } catch (PDOException $e) {
//     exit('DB Connection Error:' . $e->getMessage());
// }

//↓funcs.php内の関数
$pdo = db_con();

//２．データ登録SQL作成
// :idはいったん置き皿を作っている。
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id;');
//:idに$idを入れる。PDO::PARAM_INTは型を指定
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}

// var_dump($result);

?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ブックマーク登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="bm_select.php">ブックマーク一覧</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="index.php">トップ</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <!-- textareはvalueは使えないのでタグ間に直接入れている -->
     <!-- idは書き変えられたくないので、type = hiddenにしている -->
    <form method="POST" action="bm_update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマーク</legend>
                <label>書籍名：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
                <label>書籍URL：<input type="text" name="url" value="<?= $result['url'] ?>"></label><br>
                <label>コメント：<input type="text" name="comment" value="<?= $result['comment'] ?>"></label><br>
                <input type="hidden" name="id" value="<?= $result['id'] ?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>

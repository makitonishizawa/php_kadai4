<?php

session_start();

//セキュリティのため、クロスサイトスクリプティングを防ぐため、文字列化の関数作る
//セキュリティについてはIPA(情報処理推進機構）のサイトを参照するのがよい。もしくは「とくまるぼん」
//funcs.phpに関数が保存されているので、それを呼び出す


require_once('funcs.php');


//1.  DB接続します
//intert.ppからコピペ
try {
  //ID:'root', Password: xamppは 空白 ''
  $pdo = new PDO('mysql:dbname=gs_db_kadai4;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
$table="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  //".="は上書きせずに追記することができる。
  //h関数で文字列化している
  // while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
  //   $view .= '<p>';
  //   $view .= h($result['date']) . ' ' . h($result['name']) . ' ' . h($result['url']) . ' ' . h($result['comment']); 
  //   $view .= '</p>';
  
    // $viewDate = h($result['date']);
    // $viewName = h($result['name']);
    // $viewUrl = h($result['url']);
    // $viewComment = h($result['comment']);
  
  // }
    // HTMLテーブルの開始タグ
    $table .= '<table border="1" class="table">';
    $table .= '<tr><th>日時</th><th>書籍名</th><th>URL</th><th>コメント</th></tr>';

    // データベースから取得した各行をテーブル行として追加
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $table .= '<tr>';
      $table .= '<td class="date">' . htmlspecialchars($result['date']) . '</td>';
      $table .= '<td class="name">' . htmlspecialchars($result['name']) . '</td>';
      $table .= '<td class="url">' . htmlspecialchars($result['url']) . '</td>';
      $table .= '<td class="comment">' . htmlspecialchars($result['comment']) . '</td>';
      $table .= '</tr>';
    }
    // HTMLテーブルの終了タグ
    $table .= '</table>';

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 18px;
        text-align: left;
        table-layout: fixed;
        word-wrap: break-word;
      }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
      }
      th {
        background-color: lightblue;
      }
      .container {
        max-width: 1200px;
        margin: auto;
      }
      .navbar {
        margin-bottom: 20px;
      }
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="bm_select2.php">ブックマーク編集</a>
      <a class="navbar-brand" href="index.php">トップ</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<!-- <div>
    <div class="container jumbotron"><?= $view ?></div>
</div> -->

<div>
    <div class="table"><?= $table ?></div>
</div>

<!-- Main[End] -->

</body>
</html>

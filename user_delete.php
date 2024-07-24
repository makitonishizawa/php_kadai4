<?php
//funcs.phpの中の関数を呼び出し
require_once('user_funcs.php');

$id = $_GET['id'];

//2. DB接続します
//*** function化する！  *****************
try {
    $db_name = 'gs_db_kadai4'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

//３．データ登録SQL作成
// Deleteは絶対WHERE忘れない！
$stmt = $pdo->prepare('DELETE FROM gs_user_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_INTなので注意
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    redirect('user_select.php');
}

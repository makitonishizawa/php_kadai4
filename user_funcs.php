<?php
//XSS対応（ echoする場所で使用！）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。
//※ DBname等、今回の授業に合わせる。
//関数の外で使うためにはreturnを入れる必要がある
function db_con(){
    try {
        $db_name = 'gs_db_kadai4'; //データベース名
        $db_id   = 'root'; //アカウント名
        $db_pw   = ''; //パスワード：MAMPは'root'
        $db_host = 'localhost'; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)
//関数の外の世界から中に渡すために、()の中に$stmtを記載する
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
}
//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    //*** function化する！*****************
    header('Location: '.$file_name);
    exit();
}

// ログインチェク処理 loginCheck()
function loginCheck()
{
    //!は逆になる。よって以下は、持っていない人もしくは異なる人が最初に来る。||はまたはの意味
    //$_SESSIONはグローバル変数にするための仕組み。これに代入することで他のページでも使える。
    if ( !isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] !== session_id()) {
        //エラー
            exit('LOGIN ERROR');
        }
            session_regenerate_id(true);
            $_SESSION['chk_ssid'] = session_id();
        
}


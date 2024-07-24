<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
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
                <div class="navbar-header"><a class="navbar-brand" href="bm_select.php">ブックマーク一覧</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="index.php">トップ</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] methodは中身を変えるものはpost、中身を見るだけならget-->
    <form method="post" action="bm_insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマークアプリ</legend>
                <label>書籍名：<input type="text" name="name"></label><br>
                <label>書籍URL：<input type="text" name="url"></label><br>
                <label>コメント:<br><textArea name="comment" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>

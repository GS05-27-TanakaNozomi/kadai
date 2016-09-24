<?php
session_start();
include("functions.php");
ssidCheck();
//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();

//3.SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  $row = $stmt->fetch();
}


?>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <title>POSTデータ登録</title>
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
                    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div></div>
            </nav>
        </header>
        <!-- Head[End] -->
        <!-- Main[Start] -->
        <form method="post" action="bm_update.php">
            <div class="jumbotron">
                <fieldset>
                    <legend>登録本</legend>
                    <label>書籍名：
                        <input type="text" name="name" value="<?=$row["name"]?>">
                    </label>
                    <br>
                    <label>書籍URL：
                        <input type="text" name="url" value="<?=$row["url"]?>">
                    </label>
                    <br>
                    <label>
                        <textArea name="comment" rows="4" cols="40">
                            <?=$row["comment"]?>
                        </textArea>
                    </label>
                    <br>
                    <input type="hidden" name="id" value="<?=$id?>">
                    <input type="submit" value="送信"> </fieldset>
            </div>
        </form>
        <!-- Main[End] -->
    </body>

    </html>
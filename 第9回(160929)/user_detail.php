<?php
session_start();
include("functions.php");
ssidCheck();

//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();

//3.SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
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
        <?php
            if($_SESSION["kanri_flg"]==1){
            include("admenu.html");
            }else{
            include("menu.html");        
            }
        ?>
        <!-- Head[End] -->
        <!-- Main[Start] -->
        <form method="post" action="user_update.php">
            <div class="jumbotron">
                <fieldset>
                    <legend>登録情報</legend>
                    <label>登録名：
                        <input type="text" name="name" value="<?=$row["name"]?>">
                    </label>
                    <br>
                    <label>登録ID：
                        <input type="text" name="lid" value="<?=$row["lid"]?>">
                    </label>
                    <br>
                    <label>登録パスワード：
                        <input type="text" name="lpw" value="<?=$row["lpw"]?>">
                    </label>
                    <br>
                    <input type="hidden" name="id" value="<?=$id?>">
                    <input type="submit" value="送信"> </fieldset>
            </div>
        </form>
        <!-- Main[End] -->
    </body>

    </html>
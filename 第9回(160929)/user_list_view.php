<?php
session_start();
//0.外部ファイルを読み込む
include("functions.php");

ssidCheck();

//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view .= '<a href="user_detail.php?id='.$result["id"].'">';
    $view .= h($result["name"])."[".h($result["lid"])."]";
    $view .= '</a>　';
    $view .= '<a href="user_delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ユーザー一覧</title>
        <link rel="stylesheet" href="css/range.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            div {
                padding: 10px;
                font-size: 16px;
            }
        </style>
    </head>

    <body id="main">
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
        <div>
            <div class="container jumbotron">
                <?= $view?>
            </div>
        </div>
        <!-- Main[End] -->
    </body>

    </html>
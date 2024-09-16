<?php
//エラー表示 (全部これ)
ini_set("display_errors", 1);

$id = $_GET["id"];

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM kadai08 WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$v="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//全データ取得
$v =  $stmt->fetch(); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="index.php">ホームへ戻る</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend></legend>
     <label>手法名：<input type="text" name="name" value="<?=$v["name"]?>"></label><br>
     <label>URL：<input type="text" name="url" value="<?=$v["url"]?>"></label><br>
     <label><textArea name="memo" rows="4" cols="40"><?=$v["memo"]?></textArea></label><br>
     <input type="submit" value="更新">
     <input type="hidden" name="id" value="<?=$v["id"]?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>


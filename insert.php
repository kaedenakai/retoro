<?php
//エラー表示
ini_set("display_errors", 1);

//1. POSTデータ取得
$name = $_POST["name"];
$url = $_POST["url"];
$memo = $_POST["memo"];

//2. DB接続します phpのドキュメントに乗ってる書き方そのまま
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_kadai;charset=utf8;host=localhost','root',''); //ここがIDとPASS
} catch (PDOException $e) {
  //exitに文字を渡すとphpは処理が止まる仕様
  exit('DBError:'.$e->getMessage());
}


//３．データ登録SQL作成
//データの受け渡しはphp以外にもセキュリティ上の約束がある
$spl = "INSERT INTO kadai08(name,url,memo,indate)VALUE(:name, :url, :memo, sysdate())";
$stmt = $pdo->prepare($spl); //pdoの中のprepareにsqlを入れる
//bindvalueはインジェクションを防ぐ変数、バインド変数に無効化したものを格納してsqlに渡してくれる
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>

<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
//DB変えたらここいじる
function db_conn(){
    try {
        $db_name = "";    //データベース名
        $db_id   = "";      //アカウント名
        $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
        $db_host = ""; //DBホスト
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    } catch (PDOException $e) { //returnで関数を外に出して使えるようにしている
        exit('DB Connection Error:'.$e->getMessage());
    }    
}


//SQLエラー関数：sql_error($stmt)

function sql_error($stmt){ //外の関数を引き数で持ち込む
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);    
}




//リダイレクト関数: redirect($file_name)
function redirect($filename){
    header("Location: ".$filename);
    exit();
}

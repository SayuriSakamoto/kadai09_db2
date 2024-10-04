<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$url  = $_POST["url"];
$naiyou = $_POST["naiyou"];
$age    = $_POST["age"];


//2. DB接続します
include("funcs.php"); //外部ファイル読み込み
$pdo =db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(name,url,age,naiyou,indate)VALUES(:name,:url,:age,:naiyou,sysdate())");
$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url',  $url,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age',    $age,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    //*** function化する！*****************
 
    redirect("index.php");
}
?>

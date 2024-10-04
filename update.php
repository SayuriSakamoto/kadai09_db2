<?php
// 1. POSTデータ取得
$name   = $_POST["name"];
$url    = $_POST["url"];    // フィールド名 'email' を 'url' に修正
$naiyou = $_POST["naiyou"];
$age    = $_POST["age"];
$id     = $_POST["id"];

// 2. DB接続します
include("funcs.php"); // 外部ファイル読み込み
$pdo = db_conn();

// 3. データ登録SQL作成
$sql = "UPDATE gs_an_table SET name=:name, url=:url, age=:age, naiyou=:naiyou WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);
$stmt->bindValue(':url',    $url,    PDO::PARAM_STR);  // 'email'を 'url' に変更
$stmt->bindValue(':age',    $age,    PDO::PARAM_INT);
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);
$status = $stmt->execute(); // 実行

// 4. データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    // リダイレクト先のファイル名を修正
    redirect("select.php");
}
?>

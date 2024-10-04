<?php
$id = $_GET["id"];
// insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();

// 2. データ登録SQL作成
$sql = "SELECT * FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  // Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

// 3. データ表示
if($status==false) {
    sql_error($stmt);
}

// 全データ取得
$value = $stmt->fetch(PDO::FETCH_ASSOC);  // 単一レコードを取得し、$vに格納
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div { padding: 10px; font-size: 16px; }</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>Book登録　更新</legend>
     <label>本のタイトル：<input type="text" name="name" value="<?=$value["name"]?>"></label><br>
     <label>本のURL：<input type="text" name="url" value="<?=$value["url"]?>"></label><br> <!-- フィールド名を 'url' に修正 -->
     <label>年齢：<input type="text" name="age" value="<?=$value["age"]?>"></label><br>
     <label><textarea name="naiyou" rows="4" cols="40"><?=$value["naiyou"]?></textarea></label><br>
     <input type="hidden" name="id" value="<?=$value["id"]?>"> <!-- IDを非表示で送信 -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>

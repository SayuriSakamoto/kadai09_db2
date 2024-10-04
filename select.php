<?php
//【重要】
// insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();

// 1. 全てのデータを取得するSQLを作成
$sql = "SELECT * FROM gs_bm_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// 2. データ取得とエラーチェック
if ($status == false) {
    sql_error($stmt);
} else {
    // 全データ取得
    $values = $stmt->fetchAll(PDO::FETCH_ASSOC);  // カラム名のみで取得
    $json = json_encode($values, JSON_UNESCAPED_UNICODE);  // JSONエンコード
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book登録　表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>div { padding: 10px; font-size: 16px; }</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">データ登録</a>
            </div>
        </div>
    </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
        <table>
            <?php foreach ($values as $value) { ?>
                <tr>
                    <td><?= h($value["id"]) ?></td>
                    <td><?= h($value["name"]) ?></td>
                    <td><a href="detail.php?id=<?= h($value["id"]) ?>">更新</a></td>
                    <td><a href="delete.php?id=<?= h($value["id"]) ?>">削除</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<!-- Main[End] -->

<!-- JavaScript to log JSON data -->
<script>
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));
</script>
</body>
</html>

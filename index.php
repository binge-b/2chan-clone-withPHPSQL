<?php
// 2ちゃんねるクローンのphpの原理：上から下に読み込まれる、まずinclude_onceにぶつかって、データベース取得され、次に書き込むボタンのif文の処理が読まれ、書き込んだらデータベースに挿入と掲示文への値のセットが実行される。
include_once("./app/database/connect.php");
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP勉強中! ^o^</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include("app/parts/header.php"); ?>
    <?php include("app/parts/validation.php"); ?>
    <?php include("app/parts/thread.php"); ?>
    <?php include("app/parts/newTreadButton.php"); ?>

</body>

</html>
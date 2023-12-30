<?php
// 2ちゃんねるクローンのphpの原理：上から下に読み込まれる、まずinclude_onceにぶつかって、データベース取得され、次に書き込むボタンのif文の処理が読まれ、書き込んだらデータベースに挿入と掲示文への値のセットが実行される。

// PHPの変数宣言$が必要
// $title = "HelloPHP!";
// デバッグ型と値を確認※基本よく使う
// var_dump($title);
// 中身だけを確認
// print_r($title);

include_once("./app/database/connect.php");

// スーパーグローバル変数 — すべてのスコープで使用できる組み込みの変数
// 書き込むボタンが押されたときの処理をif文で書く。ワーニングを回避する,もしも書き込むボタン「submitButton」にuserneme,bodyが入っていたら以下の処理する
if (isset($_POST["submitButton"])) {
    // $username = $_POST["username"];
    // var_dump($username);
    // $body = $_POST["body"];
    // var_dump($body);

    $post_date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO `comment` (`username`, `body`, `post_date`) VALUES (:username, :body, :post_date);";
    $statement = $pdo->prepare($sql);

    // データベースから取得した値を掲示板にセットする。
    $statement->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
    $statement->bindParam(":body", $_POST["body"], PDO::PARAM_STR);
    $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);

    $statement->execute();
}

$comment_array = array();

// phpmyadminで作成したテーブルcommentからすべてのデータを取得するためのSQL文
$sql = "SELECT * FROM comment";
$statement = $pdo->prepare($sql);
$statement->execute();

$comment_array = $statement;

// var_dump($comment_array->fetchAll());
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP勉強中! ^o^</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <h1 class="title">2ちゃんねるクローン作成中!</h1>
        <hr>
    </header>

    <!-- スレッドエリア -->
    <div class="threadWrapper">
        <div class="childWrapper">
            <div class="threadTitle">
                <span>【タイトル】</span>
                <h1>2ちゃんねる掲示板を作ってみた</h1>
            </div>
            <section>
                <?php foreach ($comment_array as $comment) : ?>
                    <article>
                        <div class="wrapper">
                            <div class="nameArea">
                                <span>名前:</span>
                                <p class="username"><?php echo $comment["username"]; ?></p>
                                <time><?php echo $comment["post_date"]; ?></time>
                            </div>
                            <p class="comment"><?php echo $comment["body"]; ?></p>
                        </div>
                    </article>
                <?php endforeach ?>
            </section>
            <form class="formWrapper" method="POST">
                <div>
                    <input type="submit" value="書き込む" name="submitButton">
                    <label>名前:</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <textarea class="commentTextArea" name="body"></textarea>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
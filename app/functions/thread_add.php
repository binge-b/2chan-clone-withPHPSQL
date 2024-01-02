<?php
$error_message = array();

if (isset($_POST["threadSubmitButton"])) {
    // スレッド名入力チェック
    if (empty($_POST["title"])) {
        $error_message["title"] = "タイトルを入力してください。";
    } else {
        $escaped["title"] = htmlspecialchars($_POST["title"], ENT_QUOTES, "UTF-8");
    }

    // バリデーションチェック：もしも名前欄が空だったらエラーメッセージを出す処理
    if (empty($_POST["username"])) {
        $error_message["username"] = "お名前を入力してください。";
    } else {
        $escaped["username"] = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
    }

    // もしもコメント欄が空だったらエラーメッセージを出す処理
    if (empty($_POST["body"])) {
        $error_message["body"] = "コメントを入力してください。";
    } else {
        $escaped["body"] = htmlspecialchars($_POST["body"], ENT_QUOTES, "UTF-8");
    }

    if (empty($error_message)) {
        $post_date = date("Y-m-d H:i:s");
        // スレッドを追加
        $sql = "INSERT INTO `thread` (`title`) VALUES (:title);";
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":title", $escaped["title"], PDO::PARAM_STR);

        $statement->execute();

        // コメントも追加
        $sql = "INSERT INTO comment (username, body, post_date, thread_id) VALUES (:username, :body, :post_date, (SELECT id FROM thread WHERE title = :title))";
        $statement = $pdo->prepare($sql);

        // 値をセットする
        $statement->bindParam("username", $escaped["username"], PDO::PARAM_STR);
        $statement->bindParam("body", $escaped["body"], PDO::PARAM_STR);
        $statement->bindParam("post_date", $post_date, PDO::PARAM_STR);
        $statement->bindParam("title", $escaped["title"], PDO::PARAM_STR);

        $statement->execute();
    }

    // topページに遷移
    header("Location: http://localhost:8080/2chan-bbs");
}

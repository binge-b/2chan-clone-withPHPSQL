<?php
// エラーメッセージの変数
$error_message = array();

// スーパーグローバル変数 — すべてのスコープで使用できる組み込みの変数
// 書き込むボタンが押されたときの処理をif文で書く。ワーニングを回避する,もしも書き込むボタン「submitButton」にuserneme,bodyが入っていたら以下の処理する
if (isset($_POST["submitButton"])) {

    // バリデーションチェック：もしも名前欄が空だったらエラーメッセージを出す処理
    if (empty($_POST["username"])) {
        $error_message["username"] = "お名前を入力してください。";
    } else {
        // エスケープ処理
        $escaped["username"] = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
    }
    // もしもコメント欄が空だったらエラーメッセージを出す処理
    if (empty($_POST["body"])) {
        $error_message["body"] = "コメントを入力してください。";
    } else {
        // エスケープ処理
        $escaped["body"] = htmlspecialchars($_POST["body"], ENT_QUOTES, "UTF-8");
    }

    // empty関数：エラーメッセージがなければ掲示板には正常に名前とコメントが出力される
    if (empty($error_message)) {
        // post_dateの値を書いておく。
        $post_date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `comment` (`username`, `body`, `post_date`, `thread_id`) VALUES (:username, :body, :post_date, :thread_id)";
        $statement = $pdo->prepare($sql);

        // データベースから取得した値を掲示板にセットする。INSERT文の`username`, `body`, `post_date`をそれぞれ決めてあげる
        $statement->bindParam(":username", $escaped["username"], PDO::PARAM_STR);
        $statement->bindParam(":body", $escaped["body"], PDO::PARAM_STR);
        $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);
        $statement->bindParam(":thread_id", $_POST["thread_id"], PDO::PARAM_STR);

        $statement->execute();
    }
}

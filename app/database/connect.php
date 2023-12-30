<?php

// mySQLのユーザーネームとパスワード
$user = "root";
$pass = "";

// DBと接続、PDOの第1引数はデータベース名、第2、3引数はユーザーネームとパスワード,
// trycatch文で接続の可否を返す
try {
    $pdo = new PDO('mysql:host=localhost;dbname=2chan-bbs', $user, $pass);
    // echo "DBとの接続に成功しました!わっしょーい!";
} catch (PDOException $error) {
    echo $error->getMessage();
}

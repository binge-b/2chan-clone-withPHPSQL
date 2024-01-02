<?php
$comment_array = array();

// コメントデータを作成したテーブルcommentからすべてのデータを取得するためのSQL文
$sql = "SELECT * FROM comment";
$statement = $pdo->prepare($sql);
$statement->execute();

$comment_array = $statement;

// var_dump($comment_array->fetchAll());
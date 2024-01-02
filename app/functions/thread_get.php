<?php
$thread_array = array();

// コメントデータを作成したテーブルthreadからすべてのデータを取得するためのSQL文
$sql = "SELECT * FROM thread";
$statement = $pdo->prepare($sql);
$statement->execute();

$thread_array = $statement;

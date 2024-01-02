<?php
// PHPの変数宣言$が必要
// $title = "HelloPHP!";
// デバッグ型と値を確認※基本よく使う
// var_dump($title);
// 中身だけを確認
// print_r($title);

// ↓includeonceが元のソースコードではindex.phpと２か所にある、最終的に出力される地点に置いてみる
// include_once("./app/database/connect.php");

include("app/functions/comment_add.php");

include("app/functions/thread_get.php");

?>
<?php foreach ($thread_array as $thread) : ?>
    <!-- スレッドエリア -->
    <div class="threadWrapper">
        <div class="childWrapper">
            <div class="threadTitle">
                <span>【タイトル】</span>
                <h1><?php echo $thread["title"] ?></h1>
            </div>
            <?php include("commentSection.php"); ?>
            <?php include("commentForm.php"); ?>

        </div>
    </div>
<?php endforeach ?>
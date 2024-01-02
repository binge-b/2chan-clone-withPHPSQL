<!-- リファクタリング後バリデーションチェックは利いているが、エラー文が出なくなってしまった件 -->

<?php if (isset($error_message)) : ?>
    <ul class="errorMessage">
        <?php foreach ($error_message as $error) : ?>
            <li><?php echo $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
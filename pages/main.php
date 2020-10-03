<?php require_once('mainController.php'); ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="common.js"></script>
</head>
<body>
<main>
    <div>
        <p>ようこそ、<?php echo $username; ?>さん</p>
        <p><input type="button" value="ログアウト" name="logout" id="logout"></p>
    </div>
    <div class="form-wrapper error-msg">
        <?php echo $err_msg1; ?>
    </div>
    <div class="contents-wrapper">
        <?php
            foreach ( $res as $value ) {
                echo $value;
            }
        ?>
    </div>
    <form method="post" action="<?php echo h( $_SERVER["PHP_SELF"] ); ?>">
        <p>コメント<textarea name="comment" rows="10" cols="70"></textarea><input type="submit" name="send" value="送信"></p>
    </form>
</main>
</body>
</html>

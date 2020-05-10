<?php require_once('loginController.php'); ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>ログイン</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-wrapper">
    <h1>ログイン</h1>
    <p>新規の方は下の「会員登録はこちら」から会員登録をしてください</p>
</div>
<div class="login-form form-wrapper">
    <form method="post" action="<?php h( $_SERVER["PHP_SELF"] ); ?>">
        <p>ユーザー名<input type="text" name="username"></p>
        <p>パスワード<input type="password" name="password"></p>
        <input type="submit" value="ログイン" name="send">
    </form>
    <a href="regist.php">会員登録はこちら</a>
</div>
<div class="form-wrapper error-msg">
    <?php echo $err_msg1; ?>
    <?php echo $err_msg2; ?>
    <?php echo $message; ?>
</div>
</body>
</html>
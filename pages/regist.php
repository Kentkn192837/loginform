<?php require_once('registController.php'); ?>
<!DOCTYPE html>
<head>
    <title>新規会員登録</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-wrapper">
    <h1>会員登録</h1>
    <ul>
        <li>既に使用されているユーザー名での登録はできません</li>
        <li>ユーザー名は50文字以内で登録してください</li>
        <li>パスワードは8文字以上で登録してください</li>
    </ul>
</div>
<div class="login-form form-wrapper">
    <form method="post" action="<?php h( $_SERVER["PHP_SELF"] ); ?>">
        <p>ユーザー名<input type="text" name="username"></p>
        <p>パスワード<input type="password" name="password"></p>
        <input type="submit" value="会員登録" name="send">
    </form>
    <a href="login.php">ログイン画面に戻る</a>
</div>
<div class="form-wrapper error-msg">
    <?php echo $err_msg1; ?>
    <?php echo $err_msg2; ?>
    <?php echo $message; ?>
</div>
</body>
</html>

<?php 
session_start();
unset( $_SESSION[ "users" ] ); 
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<p>ログアウトしました。</p>
<a href="login.php">ログイン画面へ戻る</a>
</body>
</html>
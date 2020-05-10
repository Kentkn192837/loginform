<?php 
session_start();
unset($_SESSION["users"]);

require_once("config.php");

function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// ユーザー名とパスワードを受け取る変数
(string)$username = ( isset($_POST["username"]) ) ? $_POST["username"] : "";
(string)$password = ( isset($_POST["password"]) ) ? $_POST["password"] : "";

// エラーメッセージを受け取る変数
(string)$err_msg1 = "";
(string)$err_msg2 = "";

// データベースへの接続に失敗したときのメッセージ
(string)$message = "";


if( isset($_POST["send"]) ){
    if( $username === "" ) $err_msg1 = "<p>ユーザー名を入力してください</p>";
    if( $password === "" ) $err_msg2 = "<p>パスワードを入力してください</p>";

    if( $err_msg1 === "" && $err_msg2 === "" ){
        $username = h($username);
        $password = h($password);
        try {
            $pdo = getDB();
            $stt = $pdo->prepare("SELECT username, password FROM users WHERE username=:username AND password=:password");
            $stt->bindValue(':username', $username);
            $stt->bindValue(':password', $password);
            $stt->execute();

            foreach ($stt as $row) {
                $_SESSION["users"] = array( "username" => $row["username"],
                                            "password" => $row["password"]
                                        );
            }

            if ( isset($_SESSION["users"]) ) {
                header("Location: main.php");
                exit;
            } else {
                $message = "<p>ユーザー名またはパスワードが違います</p>";
            }
        } catch(PDOException $e) {
            $message = "<p>データベースへの接続に失敗しました。" . $e->getMessage() . "</p>";
            die();
        } finally {
            $pdo = null;
        }
    }
}
?>
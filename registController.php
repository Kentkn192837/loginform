<?php
require_once("config.php");

function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function removeSpace($str) {
    $str = trim($str);
    $str = str_replace(array("\n\r", "\r", "\n", " ", "　"), "", $str);
    return $str;
}

// ユーザー名とパスワードを受け取る変数
(string)$username = ( isset($_POST["username"]) ) ? $_POST["username"] : "";
(string)$password = ( isset($_POST["password"]) ) ? $_POST["password"] : "";

// エラーメッセージを受け取る変数
(string)$err_msg1 = "";
(string)$err_msg2 = "";

// データベースへの接続に失敗したときのメッセージ
(string)$message = "";

if ( isset($_POST["send"]) ){
    $username = removeSpace($username);
    $password = removeSpace($password);
    if( $username === "" ) $err_msg1 = "<p>ユーザー名を入力してください</p>";
    if( $password === "" ) $err_msg2 = "<p>パスワードを入力してください</p>";

    if( mb_strlen($username, "UTF-8") > 50 ) $err_msg1 = "<p>ユーザー名は50文字以下で登録してください</p>";
    if( mb_strlen($password, "UTF-8") < 8 )  $err_msg2 = "<p>パスワードは8文字以上で登録してください</p>";
    if( mb_strlen($password, "UTF-8") > 100 )  $err_msg2 = "<p>パスワードが長過ぎます</p>";

    if( $err_msg1 === "" && $err_msg2 === "" ){
        $username = h($username);
        $password = h($password);

        try {
            $pdo = getDB();
            $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);

            $stt = $pdo->prepare("SELECT username FROM users WHERE username=:username");
            $stt->bindValue(':username', $username);
            $stt->execute();

            $existUser = $stt->fetch(PDO::FETCH_ASSOC);
            if ( $username === $existUser["username"] ){
                $err_msg1 = "<p>そのユーザー名は既に使用されています</p>";
            } else {
                $stt = $pdo->prepare("INSERT INTO users(username, password) VALUES(:username, :password)");
                $stt->bindValue(':username', $username);
                $stt->bindValue(':password', $password);
                $stt->execute();

                header("Location: registSucces.php");
                exit();
            }
            // var_dump($existUser);

        } catch(PDOException $e) {
            $message = "<p>データベースへの接続に失敗しました。" . $e->getMessage() . "</p>";
            die();
        } finally {
            $pdo = null;
        }
    }
}

?>
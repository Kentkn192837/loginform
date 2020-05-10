<?php 
session_start();

$username = $_SESSION["users"]["username"];

if ( !isset($_SESSION["users"]) ) {
    header("Location: login.php");
    exit;
}

// コメントが入力されていない時のエラーメッセージ
$err_msg1 = "";

// コメントを格納する変数
$comment = ( isset($_POST["comment"]) ) ? $_POST["comment"] : "";

require_once("config.php");
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

if ( isset($_POST["send"]) ) {
    if ( $comment === "" ) $err_msg1 = "<p>コメントを入力してください";
    if ( mb_strlen($comment, "UTF-8") > 300) $err_msg = "<p>コメントは300文字以内で入力してください</p>";

    if ( $err_msg1 === "" ) {
        try {
            $date = date("Y-m-d H:i:s");
            $comment = h($comment);
            $pdo = getDB();
            $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);

            $stt = $pdo->prepare("INSERT INTO bbs(username, comment, date) VALUES(:username, :comment, :date)");
            $stt->bindValue(':username', $username);
            $stt->bindValue(':comment', $comment);
            $stt->bindValue(':date', $date);
            $stt->execute();
            // echo "Test";
        } catch(PDOException $e) {
            $err_msg1 = "<p>データベースへの接続に失敗しました エラーメッセージ:" . $e->getMessage() . "</p>";
            die();
        } finally {
            $pdo = null;
        }
    }
}

// 投稿を格納する変数
$res = array();

try {
    $pdo = getDB();
    $stt = $pdo->prepare("SELECT username, comment, date FROM bbs");
    $stt->execute();

    $i = 1;
    while ( $row = $stt->fetch(PDO::FETCH_ASSOC) ) {
        $res[$i] = "<p>{$i}:{$row["username"]} {$row["date"]}<br>{$row["comment"]}</p>";
        $i++;
    }
} catch(PDOException $e) {
    $err_msg1 = "<p>データベースへの接続に失敗しました エラーメッセージ:" . $e->getMessage() . "</p>";
    die();
} finally {
    $pdo = null;
}
?>
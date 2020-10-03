<?php 
// DB Information

function getDB() {
    $dsn = "mysql:host=localhost; dbname=portfolio";
    $db_user = "testuser";
    $db_pass = "testpass";

    $pdo = new PDO($dsn, $db_user, $db_pass);
    return $pdo;
}
?>

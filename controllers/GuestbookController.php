<?php

$username = null;
$email = null;
$message =  null;
$result = false;

if (!empty($_POST)) {

    if ( !$_POST['username'] or !$_POST['email'] or !$_POST['message']){
        echo "<b>please complete all the fields</b><br><br>";
    }

    else{
        // подключаемся к серверу
        $pdo = makeConnection();
        // выполняем операции с базой данных
        $sql = "INSERT INTO guestbook (username, email, comment) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $comment);

        // вставим одну строку

        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $comment = htmlspecialchars($_POST['message']);
        $stmt->execute();

    }

}

$pdo = makeConnection();
$comments = [];
$sql = "SELECT * FROM guestbook";
$stmt = $pdo->query($sql);

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$rowCount = $stmt->rowCount();

require_once VIEWS.'guestbook/index.php';

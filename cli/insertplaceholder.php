<?php

$host = "localhost";
$user = "root";
$pass = "ghbdtn";
$dbname = "shopping";

// Create connection
try {
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // sql
  $stmt = $DBH->prepare("INSERT INTO categories (name, status) VALUES (:name, :status)");

  ## Повторяющиеся вставки в базу с использованием подготовленных запросов
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':status', $status);

  // вставим одну строку
  $name = 'one';
  $status = 1;
  $stmt->execute();

  // теперь другую строку с другими значениями
  $name = 'two';
  $status = 0;
  $stmt->execute();

  echo "Table updated successfully\n\n";
}
catch(PDOException $e) {
    echo "SQL, у нас проблемы.\n" . $e->getMessage();
    file_put_contents('PDOErrors.log', $e->getMessage(), FILE_APPEND);
}
finally {
    $DBH = null;
}

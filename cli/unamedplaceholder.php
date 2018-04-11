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
  $stmt = $DBH->prepare("INSERT INTO categories (name, status) VALUES (?, ?)");

  $stmt->bindParam(1, $name);
  $stmt->bindParam(2, $status);

  // вставим одну строку
  $name = 'cats';
  $status = 1;
  $stmt->execute();

  // теперь другую строку с другими значениями
  $name = 'gpgs';
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

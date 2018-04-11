<?php

$host = "localhost";
$user = "root";
$pass = "ghbdtn";
// $dbname = "mydb";

// Create connection
try {
  $DBH = new PDO("mysql:host=$host;", $user, $pass);
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // Create database
  $sql = "CREATE DATABASE shopping";
  $DBH->exec($sql);
  echo "Database created successfully\n\n";
}
catch(PDOException $e) {
    echo "SQL, у нас проблемы.\n" . $e->getMessage();
    file_put_contents('PDOErrors.log', $e->getMessage(), FILE_APPEND);
}
finally {
    $DBH = null;
}

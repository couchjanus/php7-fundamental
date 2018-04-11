<?php

$host = "localhost";
$user = "root";
$pass = "ghbdtn";
$dbname = "shopping";

// Create connection
try {
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // Create database

  $sql = "CREATE TABLE categories (
            id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(id),
            name VARCHAR(20) NOT NULL,
            status TINYINT(1) UNSIGNED DEFAULT 1 NOT NULL
            )";

  $DBH->exec($sql);

  echo "Table created successfully\n\n";
}
catch(PDOException $e) {
    echo "SQL, у нас проблемы.\n" . $e->getMessage();
    file_put_contents('PDOErrors.log', $e->getMessage(), FILE_APPEND);
}
finally {
    $DBH = null;
}

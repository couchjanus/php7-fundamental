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

  # набор данных, которые мы будем вставлять
  $data = array(['Black Cat', 1], ['Green Cat', 1]);

  $stmt = $DBH->prepare("INSERT INTO categories(name, status) values (?, ?)");

  $stmt->execute($data[1]);


  echo "Table updated successfully\n\n";
}
catch(PDOException $e) {
    echo "SQL, у нас проблемы.\n" . $e->getMessage();
    file_put_contents('PDOErrors.log', $e->getMessage(), FILE_APPEND);
}
finally {
    $DBH = null;
}

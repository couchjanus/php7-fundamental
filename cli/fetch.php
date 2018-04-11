<?php

$host = "localhost";
$user = "root";
$pass = "ghbdtn";
$dbname = "shopping";

// Create connection
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $stmt = $pdo->query("SELECT * FROM categories");
  $results = $stmt->fetch(PDO::FETCH_BOTH);

  echo "All categories\n\n";
  print_r($results);


  // $stmt = $pdo->query("SELECT * FROM categories");
  // $results = $stmt->fetch(PDO::FETCH_ASSOC);
  // $results = $stmt->fetch(PDO::FETCH_NUM);

  // $stmt = $pdo->query("SELECT name FROM categories");
  // $results = $stmt->fetch(PDO::FETCH_COLUMN);

  // $stmt = $pdo->query("SELECT name, status FROM categories");
  //
  // // $results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
  // $results = $stmt->fetch(PDO::FETCH_OBJ);
  //
  // echo "All categories\n\n";
  //
  // print_r($results);


  // while($row = $stmt->fetch()) {
  //       echo $row['name'] . "\n";
  //   }

}
catch(PDOException $e) {
    echo "SQL, у нас проблемы.\n" . $e->getMessage();
    file_put_contents('PDOErrors.log', $e->getMessage(), FILE_APPEND);
}
finally {
    $DBH = null;
}

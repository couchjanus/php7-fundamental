<?php
// Увидеть список доступных драйверов можно так:
print_r(PDO::getAvailableDrivers());

/**

Увидеть список доступных драйверов:

  php cli/pdotest.php
  Array

      [0] => mysql
      [1] => pgsql
      [2] => sqlite
  )

**/

$host = "localhost";
$user = "root";
$pass = "ghbdtn";
$dbname = "mydb";

// $conn = mysqli_connect($servername, $username, $password);
//
// /* проверка соединения */
// if (mysqli_connect_errno()) {
//     printf("Не удалось подключиться: %s\n", mysqli_connect_error());
//     exit();
// }
//
// echo "Connected successfully\n\n";


// Create connection
try {
  # MS SQL Server и Sybase через PDO_DBLIB
  // $DBH = new PDO("mssql:host=$host;dbname=$dbname", $user, $pass);
  // $DBH = new PDO("sybase:host=$host;dbname=$dbname", $user, $pass);

  # MySQL через PDO_MYSQL
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

  echo "Connected successfully\n\n";

  # SQLite
  // $DBH = new PDO("sqlite:my/database/path/database.db");
}
catch(PDOException $e) {
    // echo $e->getMessage();
    printf("Не удалось подключиться: %s\n", $e->getMessage());
    // Не удалось подключиться: SQLSTATE[HY000] [1045] Access denied for user 'dev'@'localhost' (using password: YES)
}



# PDO::ERRMODE_EXCEPTION

// В большинстве ситуаций этот тип контроля выполнения скрипта предпочтителен. Он выбрасывает исключение, что позволяет вам ловко обрабатывать ошибки и скрывать щепетильную информацию. Как, например, тут:

# подключаемся к базе данных
try {
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  # Черт! Набрал DELECT вместо SELECT!
  $DBH->prepare('DELECT name FROM posts')->execute();
}
catch(PDOException $e) {
  // В SQL-выражении есть синтаксическая ошибка, которая вызовет исключение. Мы можем записать детали ошибки в лог-файл и человеческим языком намекнуть пользователю, что что-то случилось.
    echo "SQL, у нас проблемы.\n";
    file_put_contents('PDOErrors.log', $e->getMessage(), FILE_APPEND);

    // SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'DELECT name FROM posts' at line 1
}



// Классы нужно хранить в отдельных файлах, 
// необходимо не забыть подключить файл с классом-предком 
// в файле с классом-наследником. 
// Обычно это делается при помощи функции require_once 
// чтобы избежать повторного подключения одного и того же файла.

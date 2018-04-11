# php7-fundamental

# Введение в PDO

PDO (PHP Data Objects) — расширение PHP, которое реализует взаимодействие с базами данных при помощи объектов. Отсутствует привязка к конкретной системе управления базами данных.
Заботу об особенностях синтаксиса различных СУБД PDO оставляет разработчику, но делает процесс переключения между платформами гораздо менее болезненным.

Каждый драйвер базы данных, в котором реализован интерфейс PDO, может представить специфичный для базы данных функционал в виде стандартных функций расширения. Чтобы воспользоваться возможностями PDO, необходимо использовать соответствующий конкретной базе данных PDO драйвер.

PDO_MYSQL - это драйвер, реализуюший интерфейс PHP Data Objects (PDO) и предоставляет доступ из PHP к базе данных MySQL версий 3.x, 4.x и 5.x.

# Поддержка СУБД

PDO-расширение может поддерживать любую систему управления базами данных, для которой существует PDO-драйвер.

## доступны следующие драйвера:

```php
       PDO_CUBRID ( CUBRID )
       PDO_DBLIB ( FreeTDS / Microsoft SQL Server / Sybase )
       PDO_FIREBIRD ( Firebird/Interbase 6 )
       PDO_IBM ( IBM DB2 )
       PDO_INFORMIX ( IBM Informix Dynamic Server )
       PDO_MYSQL ( MySQL 3.x/4.x/5.x )
       PDO_OCI ( Oracle Call Interface )
       PDO_ODBC ( ODBC v3 (IBM DB2, unixODBC and win32 ODBC) )
       PDO_PGSQL ( PostgreSQL )
       PDO_SQLITE ( SQLite 3 and SQLite 2 )
       PDO_SQLSRV ( Microsoft SQL Server )
       PDO_4D ( 4D )
```

Увидеть список доступных драйверов:

```php

print_r(PDO::getAvailableDrivers());

```

## Подключение

Способы подключения к разным СУБД могут незначительно отличаться. Ниже приведены примеры подключения к наиболее популярным из них. Можно заметить, что первые три имеют идентичный синтаксис, в отличие от SQLite.

# MS SQL Server и Sybase через PDO_DBLIB
```php
   try {
     # MS SQL Server и Sybase через PDO_DBLIB
     $DBH = new PDO("mssql:host=$host;dbname=$dbname", $user, $pass);
     $DBH = new PDO("sybase:host=$host;dbname=$dbname", $user, $pass);
   }
   catch(PDOException $e) {
       echo $e->getMessage();
   }

```
# MySQL через PDO_MYSQL
```php
try {
  # MySQL через PDO_MYSQL
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

}
catch(PDOException $e) {
    echo $e->getMessage();
}
```
# SQLite

```php
try {

  # SQLite
  $DBH = new PDO("sqlite:my/database/path/database.db");
}
catch(PDOException $e) {
    echo $e->getMessage();
}
```

блок try/catch – всегда стоит оборачивать в него все свои PDO-операции и использовать механизм исключений.

# Описание соединения

DSN (Data Source Name) — сведения для подключения к базе, представленные в виде строки. Синтаксис описания отличается в зависимости от используемой СУБД.

## В MySQL/MariaDB указываем:

- тип драйвера;
- имя хоста, где расположена СУБД;
- порт (необязательно, если используется стандартный порт 3306);
- имя базы данных;
- кодировку (необязательно).

## Строка DSN:

```php

  $dsn = "mysql:host=localhost;port=3306;dbname=mydb;charset=utf8";

```

Первым указывается database prefix. В примере — mysql. Префикс отделяется от остальной части строки двоеточием, а каждый следующий параметр — точкой с запятой.

## Пример правильного соединения:

```php
    $host = '127.0.0.1';
    $db   = 'test';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
```

Самое главное - режим выдачи ошибок надо задавать только в виде исключений.
- потому что во всех остальных режимах PDO не сообщает об ошибке ничего внятного,
- потому что исключение всегда содержит в себе незаменимый stack trace,
- исключения чрезвычайно удобно обрабатывать.

очень удобно задать FETCH_MODE по умолчанию, чтобы не писать его в КАЖДОМ запросе.

Также здесь можно задавать режим pconnect, эмуляции подготовленных выражений и другое.


# Подключаемся к базе данных

PDO умеет выбрасывать исключения при ошибках, поэтому все должно находиться в блоке try/catch.

```php

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

```

# Закрыть любое подключение
Закрыть любое подключение можно путем переопределения его переменной в null.

```php
# закрывает подключение
$DBH = null;
```
http://php.net/manual/ru/book.pdo.php.

## Исключения и PDO

Параметр выбора режима ошибок PDO::ATTR_ERRMODE используется для определения поведения PDO в случае ошибок.

Доступно три варианта: PDO::ERRMODE_SILENT, PDO::ERRMODE_EXCEPTION и PDO::ERRMODE_WARNING.

# Управление поведением PDO при ошибках
Сразу после создания подключения, PDO можно перевести в любой из трех режимов ошибок:
```php
   $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
   $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
   $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
```
ошибка при попытке соединения будет всегда вызывать исключение.

# PDO::ERRMODE_SILENT

Это режим по умолчанию. PDO просто предоставит вам код ошибки, который можно получить методами PDO::errorCode() и PDO::errorInfo(). Эти методы реализованы как в объектах запросов, так и в объектах баз данных.
Если ошибка вызвана во время выполнения кода объекта запроса, нужно вызвать метод PDOStatement::errorCode() или PDOStatement::errorInfo() этого объекта.
Если ошибка вызова объекта базы данных, нужно вызвать аналогичные методы у этого объекта.

# PDO::ERRMODE_WARNING

Этот режим вызовет стандартный Warning и позволит скрипту продолжить выполнение.
PDO также записывает информацию об ошибке. Поток выполнения скрипта не прерывается, но выдаются предупреждения.

Это может быть полезно при отладке или тестировании, когда нужно видеть, что произошло, но не нужно прерывать работу приложения.

## установка режима обработки ошибок в WARNING

```php
$dsn = 'mysql:dbname=test;host=127.0.0.1';
$user = 'googleguy';
$password = 'googleguy';

/*
По-прежнему оберните конструктор в блок try/catch, так как, даже при установке ERRMODE в WARNING,
PDO::__construct всегда будет бросать исключение PDOException, если соединение оборвалось.
*/
try {
$dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
echo 'Соединение оборвалось: ' . $e->getMessage();
exit;
}

// Следующий запрос приводит к ошибке уровня E_WARNING вместо исключения (когда таблица не существует)
$dbh->query("SELECT wrongcolumn FROM wrongtable");
```

# PDO::ERRMODE_EXCEPTION

Это предпочтительный вариант, при котором в дополнение к информации об ошибке PDO выбрасывает исключение (PDOException). Исключение прерывает выполнение скрипта, что полезно при использовании транзакций PDO.

Помимо задания кода ошибки PDO будет выбрасывать исключение PDOException, свойства которого будут отражать код ошибки и ее описание.

Режим исключений дает возможность структурировать обработку ошибок более тщательно, нежели с обычными предупреждениями PHP, а также с меньшей вложенностью кода, чем в случае работы в тихом режиме с явной проверкой возвращаемых значений при каждом обращении к базе данных.

## Создание PDO объекта и установка режима обработки ошибок

```php

$dsn = 'mysql:dbname=testdb;host=127.0.0.1';
$user = 'dbuser';
$password = 'dbpass';

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}

```

Метод PDO::errorCode() возвращает одиночный код SQLSTATE. Если необходима специфичная информация об ошибке, PDO предлагает метод PDO::errorInfo(), который возвращает массив, содержащий код SQLSTATE, код ошибки драйвера, а также строку ошибки драйвера.

## Создание базы данных и таблиц

Пользователю с логином dev и паролем secret предоставили полные права доступа к базе mydb.

```sql

CREATE DATABASE mydb;
GRANT ALL PRIVILEGES ON mydb.* TO 'dev'@'localhost'
IDENTIFIED BY 'secret';

```
## Создание базы

```php
$host = "localhost";
$user = "root";
$pass = "ghbdtn";

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
```

## создадим таблицу и заполним данными:

```sql

CREATE TABLE categories (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id),
    name VARCHAR(20) NOT NULL,
    status TINYINT(1) UNSIGNED DEFAULT 1 NOT NULL
    );

```

## создадим таблицу:
```php

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
```
## INSERT INTO:

```sql


INSERT INTO categories(name, status) VALUES('earth', 1), ('mars', 1), ('jupiter', 1);

```

## заполним таблицу данными:

```php

$host = "localhost";
$user = "root";
$pass = "ghbdtn";
$dbname = "shopping";

// Create connection
try {
  $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  // sql

  $sql = "INSERT INTO categories(name, status) VALUES('earth', 1), ('mars', 1), ('jupiter', 1)";

  $DBH->exec($sql);

  echo "Table updated successfully\n\n";
}
catch(PDOException $e) {
    echo "SQL, у нас проблемы.\n" . $e->getMessage();
    file_put_contents('PDOErrors.log', $e->getMessage(), FILE_APPEND);
}
finally {
    $DBH = null;
}

```

## Выполнение запросов.

В PDO два способа выполнения запросов:

- прямой, который состоит из одного шага;
- подготовленный, который состоит из двух шагов.

Если в запрос не передаются никакие переменные, то можно воспользоваться функцией query(). Она выполнит запрос и вернёт специальный объект — PDO statement.

Получить данные из этого объекта можно как традиционным образом, через while, так и через foreach().

```php
$stmt = $pdo->query('SELECT name FROM users');
while ($row = $stmt->fetch())
{
    echo $row['name'] . "\n";
}
```

# Прямые запросы

Существует два метода выполнения прямых запросов:

- query используется для операторов, которые не вносят изменения, например SELECT. Возвращает объект PDOStatemnt, из которого с помощью методов fetch или fetchAll извлекаются результаты запроса;
- exec используется для операторов вроде INSERT, DELETE или UPDATE. Возвращает число обработанных запросом строк.

```php

$sql = "INSERT INTO categories(name, status) VALUES('earth', 1), ('mars', 1), ('jupiter', 1)";

$DBH->exec($sql);

```
Прямые операторы используются только в том случае, если в запросе отсутствуют переменные и есть уверенность, что запрос безопасен и правильно экранирован.


## Подготовленные выражения

Если в запрос передаётся хотя бы одна переменная, то этот запрос в обязательном порядке должен выполняться только через подготовленные выражения.

Примеры:
```php
$sql = 'SELECT name FROM users WHERE email = ?';
$sql = 'SELECT name FROM users WHERE email = :email';
```
Чтобы выполнить такой запрос, сначала его надо подготовить с помощью функции prepare(). Она также возвращает PDO statement, но ещё без данных. Чтобы их получить, надо исполнить этот запрос, предварительно передав в него переменные. Передать можно двумя способами:

Чаще всего можно просто выполнить метод execute(), передав ему массив с переменными:
```php`
$stmt = $pdo->prepare('SELECT name FROM users WHERE email = ?');
$stmt->execute(array($email));

$stmt = $pdo->prepare('SELECT name FROM users WHERE email = :email');
$stmt->execute(array('email' => $email));
```
Как видно, в случае именованных плейсхолдеров в execute() должен передаваться массив, в котором ключи должны совпадать с именами плейсхолдеров.

Иногда может потребоваться второй способ, когда переменные сначала привязывают к запросу по одной, с помощью bindValue() / bindParam(), а потом только исполняют. В этом случае в execute() ничего не передается.
Используя этот метод, всегда следует предпочесть bindValue()? поскольку поведение bindParam() не очевидно.

После этого можно использовать PDO statement Например, через foreach:

```php
$stmt = $pdo->prepare('SELECT name FROM users WHERE email = ?');

$stmt->execute([$_GET['email']]);
foreach ($stmt as $row)
{
    echo $row['name'] . "\n";
}
```
Подготовленные выражения - основная причина использовать PDO, поскольку это единственный безопасный способ выполнения SQL запросов, в которых участвуют переменные.

# Insert и Update

Вставка новых и обновление существующих данных являются одними из наиболее частых операций с БД. В случае с PDO этот процесс обычно состоит из двух шагов.

Тривиальный пример вставки новых данных:

```php
    $stmt = $pdo->prepare("INSERT INTO categories(name, status) VALUES('Cat', 1)");

    $stmt->execute();
```

Вообще-то можно сделать то же самое одним методом exec(), но двухшаговый способ дает все преимущества prepared statements. Они помогают в защите от SQL-инъекций, поэтому имеет смысл их использовать даже при однократном запросе.

# Подготовленные запросы

Большинство баз данных поддерживают концепцию подготовленных запросов.
Это некий вид скомпилированного шаблона SQL запроса, который будет запускаться приложением и настраиваться с помощью входных параметров.

PDO поддерживает подготовленные запросы (prepared statements), которые полезны для защиты приложения от SQL-инъекций: метод prepare выполняет необходимые экранирования.

У подготовленных запросов есть два главных преимущества:

1. Запрос необходимо однажды подготовить и затем его можно запускать столько раз, сколько нужно, причем как с теми же, так и с отличающимися параметрами. Когда запрос подготовлен, СУБД анализирует его, компилирует и оптимизирует план его выполнения. В случае сложных запросов этот процесс может занимать ощутимое время и заметно замедлить работу приложения, если потребуется много раз выполнять запрос с разными параметрами. При использовании подготовленного запроса СУБД анализирует/компилирует/оптимизирует запрос любой сложности только один раз, а приложение запускает на выполнение уже подготовленный шаблон. Таким образом подготовленные запросы потребляют меньше ресурсов и работают быстрее.
2. Параметры подготовленного запроса не требуется экранировать кавычками; драйвер это делает автоматически. Если в приложении используются исключительно подготовленные запросы, разработчик может быть уверен, что никаких SQL-инъекций случиться не может (однако, если другие части текста запроса речь идет именно о параметрах).

Подготовленные запросы также полезны тем, что PDO может эмулировать их, если драйвер базы данных не имеет подобного функционала. Это значит, что приложение может пользоваться одной и той же методикой доступа к данным независимо от возможностей СУБД.


# без placeholders - дверь SQL-инъекциям открыта!

```php
    $STH = $DBH->prepare("INSERT INTO categories(name, status) values ($name, $status)");

```

## Псевдопеременные могут быть двух типов: неименнованые и именованные.

# Именованные псевдопеременные

При использовании именованных псевдопеременных (named placeholders) порядок передачи значений для подстановки не важен, но код в этом случае становится не таким компактным. В метод execute данные передаются в виде ассоциативного массива, в котором каждый ключ соответствует имени псевдопеременной, а значение массива — значению, которое требуется подставить в запрос.

Методы prepare и execute используются как при выполнении запросов на изменение, так и при выборке.

А информацию о количестве обработанных строк при необходимости предоставит метод rowCount.

# Методы bindValue и bindParam

Для подстановки значений в запросе можно также использовать методы bindValue и bindParam.

Метод bindValue связывает значение переменной с псевдопеременной, которая использована при подготовке запроса:

```php
  $stmt = $pdo->prepare("INSERT INTO categories (name, status) VALUES (:name, :status)");
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);

// Связали значение переменной $name с псевдопеременной :name.
```

при использовании методов bindValue и bindParam как третий аргумент указывается тип переменной, используя соответствующие константы PDO (PDO::PARAM_STR).

# Метод bindParam
Метод bindParam привязывает переменную к псевдопеременной. В этом случае переменная связана с псевдопеременной ссылкой, а значение будет подставлено в запрос только после вызова метода execute.

```php
  # первым аргументом является имя placeholder
  # его принято начинать с двоеточия
  # хотя работает и без них
  $stmt->bindParam(':name', $name);

  $stmt->bindParam(':name', $name, PDO::PARAM_STR);

```

## Требуется вставить свойства в таблицу categories.

Сначала подготовим запрос:

Используем метод prepare, который принимает как аргумент SQL-запрос с псевдопеременными (placeholders).

```php

  $stmt = $dbh->prepare("INSERT INTO categories (name, status) VALUES (:name, :status)");

```

## Повторяющиеся вставки в базу с использованием подготовленных запросов

```php
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

```

Здесь тоже можно передавать массив, но он должен быть ассоциативным. В роли ключей должны выступать, как можно догадаться, имена placeholder.

```php

# данные, которые мы вставляем

$data = array( 'name' => 'Cathy', 'status' => 0 );

$stmt = $DBH->prepare("INSERT INTO categories (name, status) values (:name, :status)");

$stmt->execute($data);

```
Преобразование объекта в массив при execute() приводит к тому, что свойства считаются ключами массива.

# Неименованные псевдопеременные

Неименованные псевдопеременные (positional placeholders) отмечаются символом ?. Запрос в результате получается компактным, но требуется предоставить значения для подстановки, размещенные в том же порядке.

## Повторяющиеся вставки в базу с использованием подготовленных запросов

Используем метод prepare, который принимает как аргумент SQL-запрос с псевдопеременными (placeholders).

```php
    $stmt = $pdo->prepare("INSERT INTO categories(name, status) VALUES(?, ?)");
```

2 раза выполняется INSERT запрос с разными значениями name и status, которые подставляются вместо псевдопеременных ?.

```php
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $status);

// вставим одну строку
$name = 'one';
$status = 1;
$stmt->execute();

// теперь другую строку с другими значениями
$name = 'two';
$status = 0;
$stmt->execute();

```

Здесь два шага. На первом мы назначаем всем placeholder’ам переменные:

```php

$stmt->bindParam(1, $name);
$stmt->bindParam(2, $status);

```
Затем назначаем этим переменным значения и выполняем запрос.

Чтобы послать новый набор данных, просто измените значения переменных и выполните запрос еще раз.

Если в вашем SQL-выражении много параметров, то назначать каждому по переменной весьма неудобно. В таких случаях можно хранить данные в массиве и передавать его:

```php
# набор данных, которые мы будем вставлять
$data = array(['Black Cat', 1], ['Green Cat', 1]);

$stmt = $DBH->prepare("INSERT INTO categories(name, status) values (?, ?)");

$stmt->execute($data[0]);
```

$data[0] вставится на место первого placeholder’а, $data[1] — на место второго, и т.д.


## Множественное выполнение.

Также prepare() / execute() могут использоваться для многократного выполнения единожды подготовленного запроса с разными наборами данных. На случай, если онадобится выполнять делать много однотипных запросов, то можно писать так:

```php
$data = array(
1 => 1000,
5 => 300,
9 => 200,
);

$stmt = $pdo->prepare('UPDATE users SET bonus = bonus + ? WHERE id = ?');
foreach ($data as $id => $bonus)
{
    $stmt->execute([$bonus,$id]);
}
```
Здесь мы один раз подготавливаем запрос, а затем много раз выполняем.

# Выборка данных

Данные можно получить с помощью метода ->fetch(), который служит для последовательного получения строк из БД.

```php
$stmt = $pdo->prepare('SELECT name FROM users WHERE email = ?');
$stmt->execute([$_GET['email']]);
while ($row = $stmt->fetch(PDO::FETCH_LAZY))
{
    echo $row[0] . "\n";
    echo $row['name'] . "\n";
    echo $row->name . "\n";
}
```
В этом режиме не тратится лишняя память, и к тому же к колонкам можно обращаться любым из трех способов - через индекс, имя, или свойство.

Перед вызовом метода ->fetch() желательно явно указать, в каком виде они вам требуются. Есть несколько вариантов:

- PDO::FETCH_ASSOC: возвращает массив с названиями столбцов в виде ключей
- PDO::FETCH_BOTH (по умолчанию): возвращает массив с индексами как в виде названий стобцов, так и их порядковых номеров
- PDO::FETCH_BOUND: присваивает значения столбцов соответствующим переменным, заданным с помощью метода ->bindColumn()
- PDO::FETCH_CLASS: присваивает значения столбцов соответствующим свойствам указанного класса. Если для какого-то столбца свойства нет, оно будет создано
- PDO::FETCH_INTO: обновляет существующий экземпляр указанного класса
- PDO::FETCH_LAZY: объединяет в себе PDO::FETCH_BOTH и PDO::FETCH_OBJ
- PDO::FETCH_NUM: возвращает массив с ключами в виде порядковых номеров столбцов
- PDO::FETCH_OBJ: возвращает анонимный объект со свойствами, соответствующими именам столбцов

На практике вам обычно хватит трех: FETCH_ASSOC, FETCH_CLASS, и FETCH_OBJ.

Чтобы задать формат данных, используется следующий синтаксис:

```php
      $STH->setFetchMode(PDO::FETCH_ASSOC);
```
Также можно задать его напрямую при вызове метода ->fetch().

# Определение метода выборки по умолчанию

PDO::DEFAULT_FETCH_MODE — важный параметр, который определяет метод выборки по умолчанию. Указанный метод используется при получении результата выполнения запроса.

## PDO::FETCH_BOTH

Режим по умолчанию. Результат выборки индексируется как номерами (начиная с 0), так и именами столбцов:
```php
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $stmt = $pdo->query("SELECT * FROM categories");
  $results = $stmt->fetch(PDO::FETCH_BOTH);

  echo "All categories\n\n";
  print_r($results);
}
catch(PDOException $e) {
    echo "SQL, у нас проблемы.\n" . $e->getMessage();
    file_put_contents('PDOErrors.log', $e->getMessage(), FILE_APPEND);
}
finally {
    $DBH = null;
}
```

После выполнения запроса с этим режимом к тестовой таблице планет получим следующий результат:

```php

# All categories

Array
(
    [id] => 1
    [0] => 1
    [name] => earth
    [1] => earth
    [status] => 1
    [2] => 1
)
```

# PDO::FETCH_ASSOC

Результат сохраняется в ассоциативном массиве, в котором ключ — имя столбца, а значение — соответствующее значение строки:

```php

# поскольку это обычный запрос без placeholder’ов,
# можно сразу использовать метод query()

$stmt = $pdo->query("SELECT * FROM categories");

# устанавливаем режим выборки
$results = $stmt->fetch(PDO::FETCH_ASSOC);

echo "All categories\n\n";
print_r($results);
```
В результате получим:

```php
  Array
  (
    [id] => 1
    [name] => earth
    [status] => 1
  )
```
## Цикл while() переберет весь результат запроса.

```php
      while($row = $stmt->fetch()) {
            echo $row['name'] . "\n";
            echo $row['status'] . "\n";
        }
```

# PDO::FETCH_NUM

При использовании этого режима результат представляется в виде массива, индексированного номерами столбцов (начиная с 0):
```php
Array
(
  [0] => 1
  [1] => earth
  [2] => 1
)
```

# PDO::FETCH_COLUMN

Этот вариант полезен, если нужно получить перечень значений одного поля в виде одномерного массива, нумерация которого начинается с 0.

Например:
```php
$stmt = $pdo->query("SELECT name FROM categories");
$results = $stmt->fetch(PDO::FETCH_COLUMN);

echo "All categories\n\n";
print_r($results);


while($row = $stmt->fetch()) {
      echo $row['name'] . "\n";
  }
```

#  PDO::FETCH_KEY_PAIR

Используем этот вариант, если нужно получить перечень значений двух полей в виде ассоциативного массива. Ключи массива — это данные первого столбца выборки, значения массива — данные второго столбца. Например:
```php
$stmt = $pdo->query("SELECT name, status FROM categories");

$results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

echo "All categories\n\n";

print_r($results);
```

# PDO::FETCH_OBJECT

При использовании PDO::FETCH_OBJECT для каждой извлеченной строки создаётся анонимный объект. Его общедоступные (public) свойства — имена столбцов выборки, а результаты запроса используются в качестве их значений:

```php
  # создаем запрос
  $stmt = $pdo->query("SELECT name, status FROM categories");

  # выбираем режим выборки
  $results = $stmt->fetch(PDO::FETCH_OBJ);

  echo "All categories\n\n";

  print_r($results);

```

#  Получение нескольких объектов

Множественные результаты извлекаются в виде объектов с помощью метода fetch внутри цикла while:

```php
  while ($name = $stmt->fetch()) {
     // обработка результатов
  }
```
Или путём выборки всех результатов сразу. Во втором случае используется метод fetchAll, причём режим указывается в момент вызова:

```php

  $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

```

fetchAll() возвращает массив, который состоит из всех строк, которые вернул запрос. Из чего можно сделать два вывода:
1. Эту функцию не стоит применять тогда, когда запрос возвращает много данных. В таком случае лучше использовать традиционный цикл с fetch()
2. Поскольку в современных РНР приложениях данные никогда не выводятся сразу по получении, а передаются для этого в шаблон, fetchAll() становится просто незаменимой, позволяя не писать циклы вручную, и тем самым сократить количество кода.

## fetchColumn()

Также у PDO statement есть функция-хелпер для получения значения единственной колонки. Очень удобно, если мы запрашиваем только одно поле - в этом случае значительно сокращается количество писанины:

```php
$stmt = $pdo->prepare("SELECT name FROM table WHERE id=?");
$stmt->execute(array($id));
$name = $stmt->fetchColumn();
```
## Данные для подключения к БД

```php

  return [
      'database' => [
          'name' => 'shopping',
          'username' => 'root',
          'password' => 'ghbdtn',
          'connection' => 'mysql:host=localhost',
          'options' => [
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
          ]
      ]
  ];

```

# makeConnection

```php
function makeConnection()

{
  $db = include CONFIG.'db.php';
  $config = $db['database'];

  try {
    return new PDO(
      $config['connection'].';dbname='.$config['name'],
      $config['username'],
      $config['password'],
      $config['options']
    );
  }
  catch(PDOException $e) {
      echo "SQL, у нас проблемы.\n" . $e->getMessage();
      file_put_contents('PDOErrors.log', $e->getMessage(), FILE_APPEND);
  }
  finally {
      $DBH = null;
  }
}
```

```php

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

require_once VIEWS.'guestbook/index.php';

```

```php

    foreach ($comments as $row) {
      echo "<div class='top'><b>User ".$row["username"]."</b> <a href='mailto:".$row["email"]."'>".$row["email"]."</a> Added this </div>";
      echo "<div class='comment'>".strip_tags($row["comment"])."</div>";
      echo "<div class='added_at'> At: ".strip_tags($row["created_at"])."</div>";
    }

```

# Метод ->rowCount()

Метод ->rowCount() возвращает количество записей, которые поучаствовали в операции.
```php

$sql = "SELECT * FROM guestbook";
$stmt = $pdo->query($sql);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rowCount = $stmt->rowCount();

```

Если обновить версию PHP не представляется возможным, количество записей можно получить так:

```php
  $sql = "SELECT COUNT(*) FROM guestbook";
  if ($stmt = $pdo->query($sql)) {
      # проверяем количество записей
      if ($stmt->fetchColumn() > 0) {
         # делаем здесь полноценную выборку, потому что данные найдены!
      }
      else {
          # выводим сообщение о том, что удовлетворяющих запросу данных не найдено
      }
  }

```

# Метод ->lastInsertId()

  Метод ->lastInsertId() возвращает id последней вставленной записи. Стоит заметить, что он всегда вызывается у объекта базы данных ($pdo), а не объекта с выражением ($stmt).

# Метод ->exec()

  $pdo->exec('DELETE FROM guestbook WHERE 1');
  $pdo->exec("SET time_zone = '-8:00'");

  Метод ->exec() используется для операций, которые не возвращают никаких данных, кроме количества затронутых ими записей.

# Метод ->quote()

  Метод ->quote() ставит кавычки в строковых данных таким образом, что их становится безопасно использовать в запросах. Пригодится, если вы не используете prepared statements.

# PDO преимущества:

- с PDO легко перенести приложение на другие СУБД;
- поддерживаются все популярные СУБД;
- встроенная система управления ошибками;
- разнообразные варианты представления результатов выборки;
- поддерживаются подготовленные запросы, которые сокращают код и делают его устойчивым к SQL-инъекциям;
- поддерживаются транзакции, которые помогают сохранить целостность данных и согласованность запросов при параллельной работе пользователей.

```php

function render($path, $data = [])
{
    extract($data);

    return require VIEWS."/{$path}.php";
}

```
#

```php
render('home/about', ['title'=>'About <b>Our Cats</b>']);
```

```sql

CREATE TABLE posts (
    id int(11) NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    content text NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
```

# BlogController

```php

$pdo = makeConnection();
$posts = [];
$stmt = $pdo->query("SELECT * FROM posts");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rowCount = $stmt->rowCount();

render('blog/index', ['title'=>'Our <b>Cats Blog</b>', 'posts'=>$posts, 'rowCount'=>$rowCount]);

```

```php
    if ($rowCount>0) {
        echo "<h3>$rowCount posts found:</h3> ";
        foreach ($posts as $row) {
          echo "<div class='top'>".$row["title"]."</div>";
          echo "<div class='content'>".strip_tags($row["content"])."</div>";
          echo "<div class='added_at'> At: ".strip_tags($row["created_at"])."</div>";
        }
    }
    else {
      echo "No posts found.... ";
    }

```

# Router

```php

    function getURI()
    {
        if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }


    function getPathAction($route)
    {
        $segments = explode('\\', $route);
        $controller = array_pop($segments);
        $controllerPath = '/';

        do {
            if(count($segments)===0){
              return array ($controller, $controllerPath);
              } else {
                  $segment = array_shift($segments);
                  $controllerPath = $controllerPath . $segment . '/';
              }
           } while (count($segments)>=0);
    }

    // получаем строку запроса

    $uri = getURI();

    $filename = CONFIG.'routes'.EXT;

    if (file_exists($filename)) {
        $routes = include_once $filename;
    } else {
        echo "Файл $filename не существует";
    }

    // Проверить наличие такого запроса в routes

    foreach ($routes as $route => $path) {

        //Сравниваем route и $uri
        if ($route === $uri) {

            // Определить контроллер
            list($controller, $controllerPath) = getPathAction($path);
            $controllerFile = CONTROLLERS .$controllerPath . $controller . EXT;

            if (file_exists($controllerFile)) {
                include_once $controllerFile;
                $result = true;
            }

            if ($result !== null) {
                break;
            }
        }
    }

    if ($result === null) {
            include_once VIEWS.'errors/404'.EXT;
    }
```

## explode — Разбивает строку с помощью разделителя

Возвращает массив строк, полученных разбиением строки string с использованием delimiter в качестве разделителя.

## Пример использования explode()

```php
// Пример 1
$pizza  = "кусок1 кусок2 кусок3 кусок4 кусок5 кусок6";
$pieces = explode(" ", $pizza);
echo $pieces[0]; // кусок1
echo $pieces[1]; // кусок2

// Пример 2
$data = "foo:*:1023:1000::/home/foo:/bin/sh";
list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
echo $user; // foo
echo $pass; // *

// Пример 3
$data = "foo:*:1023:1000::/home/foo:/bin/sh";
list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
echo $user; // foo
echo $pass; // *

```

## extract

extract — Импортирует переменные из массива в текущую таблицу символов

Возвращает количество переменных, успешно импортированных в текущую таблицу символов.

## Пример использования extract()

Функцию extract() также можно использовать для импорта в текущую таблицу символов переменных, содержащихся в ассоциативном массиве.

```php
        $size = "large";
        $var_array = array("color" => "blue",
                           "size"  => "medium",
                           "shape" => "sphere");
        extract($var_array);

        echo "$color, $size, $shape, $wddx_size\n";

```

```php

    return [
       'contact' => 'ContactController',
       'about' => 'AboutController',
       'blog' => 'BlogController',
       'guest' => 'GuestbookController',
       'admin' => 'Admin\DashboardController',
       //Главаня страница
       'index.php' => 'HomeController',
       '' => 'HomeController',
    ];
```

```php

    render('admin/index', ['title'=>'Dashboard Controller PAGE']);
```

## list
http://php.net/manual/ru/function.list.php

list — Присваивает переменным из списка значения подобно массиву

Подобно array(), это не функция, а языковая конструкция. list() используется для того, чтобы присвоить списку переменных значения за одну операцию.
Возвращает присвоенный массив.

## Примеры использования list()
```php

$info = array('кофе', 'коричневый', 'кофеин');

// Составить список всех переменных
list($drink, $color, $power) = $info;
echo "$drink - $color, а $power делает его особенным.\n";

// Составить список только некоторых из них
list($drink, , $power) = $info;
echo "В $drink есть $power.\n";

// Или только третья
list( , , $power) = $info;
echo "Мне нужен $power!\n";

// list() не работает со строками
list($bar) = "abcde";
var_dump($bar); // NULL
```

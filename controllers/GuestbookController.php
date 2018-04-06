<?php

/** 
 * fopen
 * fclose
*/

// $fcomments = DB."comments";

// if (file_exists($fcomments)) {
//     $fhandle = fopen($fcomments, "rt");
//     $comments = '';
//     while (!feof($fhandle)) {
//         $comments .= fread($fhandle, 4096);
//     }
//     fclose($fhandle);
// } else {
//     echo "Файл не существует";
// }


// file_get_contents
// $comments = file_get_contents(DB."comments");

// count, implode, str_replace, htmlspecialchars

// $file = file(DB."comments");
// $count = count($file);
// $comments = str_replace("\n", "<br />\n", htmlspecialchars(implode("\n", $file)));

// file, str_replace, htmlspecialchars, implode 
// $comments = str_replace("\n", "<br />\n", htmlspecialchars(implode("\n", file(DB."comments"))));

$username = null;  
$email = null;  
$message =  null;  
$result = false;

// if (!empty($_POST)) {
//     $username = $_POST['username'];  
//     $email = $_POST['email'];  
//     $message =  $_POST['message'];  
 
//     if (!$username or !$email or !$message) {
//         $error = "<b>please complete all the fields</b><br><br>";
//     } else {
//         $result = true;
//     }
// }

// add comment to comments.txt

// if (!empty($_POST)) {
    
//     if ( !$_POST['username'] or !$_POST['email'] or !$_POST['message']){
//         $error = "<b>please complete all the fields</b><br><br>";
//     } else {
//         $result = true;
//         $fields = [];

//         $username = $_POST['username'];
//         array_push($fields, $username); 
//         $email = $_POST['email'];
//         array_push($fields, $email); 
//         $message = $_POST['message'];
//         array_push($fields, $message); 
//         $appended_at = date("Y-m-d");
//         array_push($fields, $appended_at); 

//         // $appended_at =  date("Y/m/d");
//         // $appended_at =  date("Y.m.d");
//         // $appended_at =  date("Y-m-d");
//         // $appended_at =  date("l");

//         $handle = fopen(DB."comments.csv", "a+");

//         $string = $username.":".$email.":".$message.":".$appended_at."\r\n";

//         // fwrite($handle, $string);

//         // file_put_contents(DB."comments.csv", $string, FILE_APPEND);

//         fputcsv($handle, $fields, ':');

//         fclose($handle);

//     }
    
// }

// $comments = [];

// $handle = fopen(DB."comments.csv", "rt");

// while (($row = fgetcsv($handle, 10000, ":")) !== false) { 
//     array_push($comments, $row); 
// } 
// fclose($handle); 

// if (!empty($_POST)) {
    
//     if ( !$_POST['username'] or !$_POST['email'] or !$_POST['message']){
//         echo "<b>please complete all the fields</b><br><br>";
//     }
//     else{
//         // подключаемся к серверу
//         $conn = mysqli_connect(HOST, DBUSER, DBPASSWORD, DATABASE) 
//         or die("Ошибка " . mysqli_error($conn));


//         $username = mysqli_real_escape_string ($conn, $_POST['username']);
//         $email = mysqli_real_escape_string ($conn, $_POST['email']);
//         $comment = mysqli_real_escape_string ($conn, $_POST['comment']);

//         // выполняем операции с базой данных

//         $sql = "INSERT INTO guestbook (username, email, comment) VALUES ('$username', '$email', '$comment')";

//         mysqli_query($conn, $sql) or die("Ошибка: " . mysqli_error($conn));
//         mysqli_close($conn);
//     }
    
// }

// $conn = mysqli_connect(HOST, DBUSER, DBPASSWORD, DATABASE) 
//         or die("Ошибка " . mysqli_error($conn));

// $comments = [];

// $sql = "SELECT * FROM guestbook";

// $result = mysqli_query($conn, $sql);

// $resCount = mysqli_num_rows($result);

// while($row = mysqli_fetch_assoc($result)){
//         array_push($comments, $row);
//     }

// // закрываем подключение
// mysqli_close($conn);

require_once VIEWS.'guestbook/index.php';
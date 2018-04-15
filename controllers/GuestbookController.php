<?php

class GuestbookController extends Controller
{
    
    public function index()
    {

        if (!empty($_POST)) {

            if ( !$_POST['username'] or !$_POST['email'] or !$_POST['message']){
                echo "<b>please complete all the fields</b><br><br>";
            }
        
            else{
                // подключаемся к серверу
                $pdo = Connection::makeConnection();
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
        
        $pdo = Connection::makeConnection();
        $comments = [];
        $sql = "SELECT * FROM guestbook";
        $stmt = $pdo->query($sql);
        
        $data['comments'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data['rowCount'] = $stmt->rowCount();
        $this->_view->render('guestbook/index', $data);
    }

}





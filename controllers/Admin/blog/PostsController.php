<?php

class PostsController extends Controller {

    public function index()
    {
      $pdo = Connection::makeConnection();
      $posts = [];
      $stmt = $pdo->query("SELECT * FROM posts");
      $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $rowCount = $stmt->rowCount();
      $data['rowCount'] = $rowCount;
      $data['posts'] = $posts;
      $data['title'] = 'Admin Posts Page ';

      $this->_view->render('admin/posts/index', $data);
    }


    public function create()
    {
      //Принимаем данные из формы
      if (isset($_POST) and !empty($_POST)) {

        $pdo = Connection::makeConnection();
        // sql
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, status) VALUES (?, ?, ?)");
        ## Повторяющиеся вставки в базу с использованием подготовленных запросов
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $content);
        $stmt->bindParam(3, $status);

        $title = trim(strip_tags($_POST['title']));
        $content = trim($_POST['content']);
        $status = trim(strip_tags($_POST['status']));
        $stmt->execute();
        header('Location: /admin/posts');
      }
      $data['title'] = 'Admin Add Post ';
      $this->_view->render('admin/posts/create', $data);
  }

}

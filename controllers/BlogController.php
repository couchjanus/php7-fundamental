<?php

class BlogController extends Controller
{
    public function index()
    {
        $pdo = Connection::makeConnection();
        $posts = [];
        $stmt = $pdo->query("SELECT * FROM posts");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rowCount = $stmt->rowCount();

        $data['title'] = 'Our <b>Cats Blog</b>';
        $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
        $data['rowCount'] = $rowCount;
        $data['posts'] = $posts;
        $this->_view->render('blog/index', $data);
    }

    public function show($vars)
    {
        extract($vars);

        $data['title'] = 'Cats Blog ';
        $data['post'] = Post::getPostBySlug($slug);
        $this->_view->render('blog/show', $data);

    }
}

<?php

$pdo = makeConnection();
$posts = [];
$stmt = $pdo->query("SELECT * FROM posts");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rowCount = $stmt->rowCount();

render('blog/index', ['title'=>'Our <b>Cats Blog</b>', 'posts'=>$posts, 'rowCount'=>$rowCount]);

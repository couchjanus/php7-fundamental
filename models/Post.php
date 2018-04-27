<?php

class Post
{
    public static function selectAll()
    {
        $pdo = Connection::makeConnection();
        $statment = $pdo->prepare("select * from posts");
        $statment->execute();
        return $statment->fetchAll();
    }

    public static function store($parameters)
    {
            $pdo = Connection::makeConnection();
            $statment = $pdo->prepare("INSERT INTO posts (title, slug, content, status) VALUES (?, ?, ?, ?)");
            
            $statment->bindParam(1, $title);
            $statment->bindParam(2, $slug);
            $statment->bindParam(3, $content);
            $statment->bindParam(4, $status);
            
            $title = $parameters['title'];
            
            $slug = Slug::makeSlug($parameters['title'], array('transliterate' => true));

            $content = $parameters['content'];
            $status = $parameters['status'];
            
            $statment->execute();
    }

    public static function getPostById($id) 
    {
        $con = Connection::makeConnection();
        $sql = "SELECT * FROM posts WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->execute();
        $post = $res->fetch(PDO::FETCH_ASSOC);
        return $post;
    }


    public static function getPostBySlug($slug) 
    {
        $con = Connection::makeConnection();
        $sql = "SELECT * FROM posts WHERE slug = :slug";
        $res = $con->prepare($sql);
        $res->bindParam(':slug', $slug, PDO::PARAM_STR);
        $res->execute();
        $post = $res->fetch(PDO::FETCH_ASSOC);
        return $post;
    }


    public static function destroy($id) 
    {
        $con = Connection::makeConnection();
        $sql = "DELETE FROM posts WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

    public static function update($id, $options) 
    {

        $con = Connection::makeConnection();

        $sql = "
                UPDATE posts
                SET
                    title = :title,
                    content = :content,
                    status = :status
                WHERE id = :id
                ";

        $res = $con->prepare($sql);
        $res->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $res->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->execute();
    }

}

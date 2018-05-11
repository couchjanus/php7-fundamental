<?php

class Post
{
    const SHOW_BY_DEFAULT = MAXPAGE;
    
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

    /**
     * Получаем последние Posts
     *
     * @param int $page
     * @return array
     */
    public static function getLatestPosts($page = 1)
    {

        $limit = self::SHOW_BY_DEFAULT;

        //Задаем смещение
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $con = Connection::makeConnection();
        
        $sql = "SELECT *
                  FROM posts
                  WHERE status = 1
                  ORDER BY id DESC
                  LIMIT :limit OFFSET :offset
                ";

        //Подготавливаем данные
        $res = $con->prepare($sql);
        $res->bindParam(':limit', $limit, PDO::PARAM_INT);
        $res->bindParam(':offset', $offset, PDO::PARAM_INT);

        //Выполняем запрос
        $res->execute();

        //Получаем и возвращаем результат
        $postList = $res->fetchAll(PDO::FETCH_ASSOC);

        return $postList;
    }

    public static function getTotalPosts()
    {

        // Соединение с БД
        $db = Connection::makeConnection();

        // Текст запроса к БД
        $sql = "SELECT count(id) AS count FROM posts WHERE status=1 ";

        // Выполнение коменды
        $res = $db->query($sql);

        // Возвращаем значение count - количество
        $row = $res->fetch();
        return $row['count'];
    }

    public static function searchPost($query)
    {
        $db = Connection::makeConnection();

        $sql = "SELECT *
            FROM posts 
            WHERE status = 1 
              and ((title LIKE '%{$query}%') 
              OR (content LIKE '%{$query}%'))";

        $res = $db->prepare($sql);
        $res->execute();
        $posts = $res->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

}

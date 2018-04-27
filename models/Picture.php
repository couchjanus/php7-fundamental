<?php

/**
 * Модель для работы с Picture
 * 
*/

class Picture
{

    const SHOW_BY_DEFAULT = 4;

    public static function index() 
    {
        $con = Connection::makeConnection();
        $sql = "SELECT * FROM pictures ORDER BY id ASC";
        $res = $con->query($sql);
        $pictures = $res->fetchAll(PDO::FETCH_ASSOC);
        return $pictures;
    }

    public static function show($id)
    {
        $con = Connection::makeConnection();
        $sql = "SELECT * FROM pictures WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->execute();
        $picture = $res->fetch(PDO::FETCH_ASSOC);
        return $picture;
    }

    public static function store($options) 
    {
        $db = Connection::makeConnection();
        $sql = "INSERT INTO pictures(resource, filename, resource_id)
                VALUES (:resource, :filename, :resource_id)";
        $res = $db->prepare($sql);
        $res->bindParam(':resource', $options['resource'], PDO::PARAM_STR);
        $res->bindParam(':filename', $options['filename'], PDO::PARAM_STR);
        $res->bindParam(':resource_id', $options['resource_id'], PDO::PARAM_INT);
        $res->execute();
    }

    public static function lastId() 
    {
        $con = Connection::makeConnection();
        $res = $con->prepare("SELECT id FROM pictures ORDER BY id DESC LIMIT 1");
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public static function getPictureById($id, $resource) 
    {
        $con = Connection::makeConnection();
        $sql = "SELECT * FROM pictures WHERE resource_id = :id and resource = :resource";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->bindParam(':resource', $resource, PDO::PARAM_STR);
        $res->execute();
        $picture = $res->fetch(PDO::FETCH_ASSOC);
        return $picture;
    }

    
    public static function update($id, $options) 
    {

    }
    
    public static function destroy($id) 
    {
        $con = Connection::makeConnection();
        $sql = "DELETE FROM pictures WHERE id = :id";
        $res = $con->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

}

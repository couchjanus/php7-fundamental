<?php

class Permission
{
    public static function index()
    {
        $db = Connection::makeConnection();

        $sql = "SELECT id, name FROM permissions
                ORDER BY id ASC";

        $res = $db->query($sql);

        $permissions = $res->fetchAll(PDO::FETCH_ASSOC);
        return $permissions;
    }

    
    public static function destroy($id)
    {
        $db = Connection::makeConnection();

        $sql = "DELETE FROM permissions WHERE id = :id";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }


    public static function store($options)
    {
        $db = Connection::makeConnection();
        $sql = "INSERT INTO permissions(name)
                VALUES (:name)
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);

        return $res->execute();
    }

    public static function get($id)
    {

        $db = Connection::makeConnection();
        $sql = "SELECT name FROM permissions
                WHERE id = :id";

        $res = $db->prepare($sql);

        $res->bindParam(':id', $id);
        $res->execute();
        $permission = $res->fetch(PDO::FETCH_ASSOC);

        return $permission;
    }

    public static function update($id, $options)
    {

        $db = Connection::makeConnection();
        $sql = "UPDATE permissions
                SET name = :name
                WHERE id = :id
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }
}

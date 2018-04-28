<?php

class Role
{
    protected $permissions;

    protected function __construct()
    {
        $this->permissions = array();
    }

    public static function index()
    {
        $db = Connection::makeConnection();

        $sql = "SELECT id, name FROM roles
                ORDER BY id ASC";

        $res = $db->query($sql);
        $roles = $res->fetchAll(PDO::FETCH_ASSOC);
        return $roles;
    }

    public static function destroy($id)
    {
        $db = Connection::makeConnection();
        $sql = "DELETE FROM roles WHERE id = :id";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

    public static function store($options)
    {
        $db = Connection::makeConnection();
        $sql = "INSERT INTO roles(name)
                VALUES (:name)";
        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        return $res->execute();
    }

    public static function getRoleById($id)
    {

        $db = Connection::makeConnection();
        $sql = "SELECT name FROM roles
                WHERE id = :id";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $id);
        $res->execute();
        $role = $res->fetch(PDO::FETCH_ASSOC);
        return $role;
    }

    public static function update($id, $options)
    {

        $db = Connection::makeConnection();
        $sql = "UPDATE roles
                SET
                    name = :name
                WHERE id = :id
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }
}

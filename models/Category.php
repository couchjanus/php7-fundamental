<?php

/**
 * Модель для работы с категориями
*/

class Category
{

    /**
    * Список категорий 
    * Возвращает массив всех категорий  
    * @return array
    **/

    public static function index()
    {
        $db = Connection::makeConnection();
        $sql = "SELECT id, name, status FROM categories
                ORDER BY id ASC";
        $res = $db->query($sql);
        $categories = $res->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }

    /**
     * Вместо числового статуса категории, отображаем определенную строку
     *
     * @param $status
     * @return string
     */
    public static function getStatusText ($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

     /**
     * Список категорий для админпанели
     * Возвращает массив всех категорий, включая те, у которых статус отображения = 0
     *
     * @return array
     */
    public static function getActiveCategories()
    {
        $db = Connection::makeConnection();
        $db->exec("set names utf8");

        $sql = "SELECT id, name, status FROM categories
                WHERE status = 1
                ORDER BY id ASC";

        $res = $db->query($sql);

        $categories = $res->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

    /**
     * Добавление категории(админка)
     *
     * @param $options массив параметров
     * @return bool
     */
    public static function store($options)
    {

        $db = Connection::makeConnection();
        $sql = "INSERT INTO categories(name, status)
                VALUES (:name, :status)";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);

        return $res->execute();
    }

    /* Удаление категории (model)    */
    public static function destroy($id)
    {
        $db = Connection::makeConnection();
        $sql = "DELETE FROM categories WHERE id = :id";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

    /* Выбор категории по id  */
    public static function getCategoryuuById($id)
    {
        $db = Connection::makeConnection();
        $sql = "SELECT name, status FROM categories  WHERE id = :id";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $id);
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC);
    }


}

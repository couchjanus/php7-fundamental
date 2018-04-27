<?php


class A
{
    public static function who()
    {
        echo __CLASS__;
    }
    public static function test()
    {
        self::who();
    }
}

// Статические ссылки на текущий класс, 
// такие как self:: или __CLASS__, 
// вычисляются используя класс, к которому эта функция принадлежит, как и в том месте, где она была определена:

class B extends A
{
    public static function who()
    {
        echo __CLASS__;
    }
}

B::test();

// Результат выполнения данного примера: A


class Model
{
    public static $table = 'table';
    public static function getTable() {
      return self::$table;
    }
}
echo Model::getTable(); // Результат выполнения данного примера: 'table'
  

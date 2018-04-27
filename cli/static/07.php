<?php

class Model
{
    public static $table = 'table';
    public static function getTable()
    {
      return self::$table;
    }
}

class Post extends Model
{
    public static $table = posts;
}

echo Post::getTable(); 

// 'table' self был связан с классом Model тогда, когда о классе Post еще ничего не было известно, поэтому и указывает на Model.
  
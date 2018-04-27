<?php

class Model
{
    public static $table = 'table';
    public static function getTable()
    {
      return static::$table;
    }
}

class Post extends Model
{
    public static $table = "posts";
}

echo Post::getTable(); // posts
// Это и есть загадочное «позднее статическое связывание». 

  
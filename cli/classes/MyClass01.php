<?php
 
class MyClass
{
  // Class properties and methods go here
 
}

// Если с директивой new используется строка (string), 
// содержащая имя класса, то будет создан новый экземпляр этого класса. 


$obj = new MyClass;

// Если имя находится в пространстве имен, 
// то оно должно быть задано полностью.

$obj = new \MyClass;

var_dump($obj);

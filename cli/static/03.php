<?php

// Методы существуют в единственном экземпляре. 

class A
{
  public function foo()
  {
    static $x = 0;
    echo ++$x;
  }
}

$a1 = new A;
$a2 = new A;
$a1->foo(); // 1
$a2->foo(); // 2
$a1->foo(); // 3
$a2->foo(); // 4


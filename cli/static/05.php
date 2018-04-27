<?php

class A
{
    public static $x = 'foo';

    public static function test()
    {
      return 42;
    }
}

echo A::$x; // 'foo'

echo A::test(); // 42

$a = new A;
echo $a->test();
  
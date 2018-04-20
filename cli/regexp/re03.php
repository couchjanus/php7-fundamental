<?php

$key = "posts/{id}";
$uri = "posts/1";
// $pattern = "/^([a-z]+)\/([0-9]+)/";
// $result = preg_match($pattern, $uri, $matches);

$pattern = preg_replace('#\(/\)#', '/?', $key);

var_dump(
    $pattern
);

$pattern = "@^" .preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern). "$@D";

var_dump($pattern);

preg_match($pattern, $uri, $matches);

var_dump($pattern, $matches);

/*
string(10) "posts/{id}"
string(34) "@^posts/(?<id>[a-zA-Z0-9\_\-]+)$@D"
string(34) "@^posts/(?<id>[a-zA-Z0-9\_\-]+)$@D"
array(3) {
  [0]=>
  string(7) "posts/1"
  ["id"]=>
  string(1) "1"
  [1]=>
  string(1) "1"
}

*/
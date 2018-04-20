<?php

// $uri = "posts";
// $pattern = "/[a-z]+/";
$uri = "posts/1";
$pattern = "/^([a-z]+)\/([0-9]+)/";
$result = preg_match($pattern, $uri, $matches);

var_dump(
    $result,
    $matches
);


/*

int(1)
array(1) {
  [0]=>
  string(5) "about"
}


int(1)
array(3) {
  [0]=>
  string(7) "posts/1"
  [1]=>
  string(5) "posts"
  [2]=>
  string(1) "1"
}

*/
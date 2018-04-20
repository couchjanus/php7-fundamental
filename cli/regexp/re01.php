<?php

$text = "hello world";
$regexp = "/o/";

$result = preg_match($regexp, $text, $match);

var_dump(
    $result,
    $match
);

$result = preg_match_all($regexp, $text, $match);
var_dump(
    $result,
    $match
);

/*

int(1)
array(1) {
  [0]=>
  string(1) "o"
}

int(2)
array(1) {
  [0]=>
  array(2) {
    [0]=>
    string(1) "o"
    [1]=>
    string(1) "o"
  }
}

*/
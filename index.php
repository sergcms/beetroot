<?php

$a = [10, 100, 5, 15, 20, 30, 50, 80, 75, 40];

for ($i=count($a)-1; $i >= 0  ; $i--) { 
    echo $a[$i] . PHP_EOL;
}

function xto ($z)
{
    return $z * 2;
}

$b = [];

foreach ($a as $value) {
    array_push($b, xto($value));
}

var_dump($b);

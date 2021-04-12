<?php

$newArray = array();
for ($i = 0; $i < 10; $i++) {
    $lol = 'lol : ' . $i;
    $newArray[$i] = $lol;
}
file_put_contents('test.json', json_encode($newArray));

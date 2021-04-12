<?php
function gen_one_to_three()
{
    for ($i = 0; $i < 3; $i++) {
        yield $i;
    }
}
// $gen = gen_one_to_three();
// print_r(gen_one_to_three());
// echo gettype($gen);
// foreach ($gen as $key => $value) {
//     echo '<pre>';
//     echo $key . ' : '  . $value;
// }
function getValuesWithReturn()
{
    $valuesArray = [];
    // Su dung bo nho ban dau
    echo round(memory_get_usage() / 1024 / 1024, 2) . 'MB' . PHP_EOL;
    for ($i = 0; $i < 800000; $i++) {
        $valuesArray[] = $i;
        // do luong viec su dung bo nho
        if (($i % 200000) == 0) {
            // su dung bo nho tinh bang megabyte
            echo round(memory_get_usage() / 1024 / 1024, 2) . 'MB' . PHP_EOL;
        }
    }
    return $valuesArray;
}
// $myValuesWithReturn = getValuesWithReturn();
// foreach ($myValuesWithReturn as $myValue) {
// }

function getValuesWithYield()
{
    // su dung bo nho ban dau
    echo round(memory_get_usage() / 1024 / 1024, 2) . 'MB' . PHP_EOL;
    for ($i = 0; $i < 800000; $i++) {
        yield $i;
        // do luong viec su dung bo nho
        if (($i % 200000) == 0) {
            // su dung bo nho tinh bang megabyte
            echo round(memory_get_usage() / 1024 / 1024, 2) . 'MB' . PHP_EOL;
        }
    }
}
$myValuesWithYield = getValuesWithYield();
foreach ($myValuesWithYield as $myValue) {
}

<?php
function test()
{
    return [
        1 => function () {
            return [
                1 => function ($a) {
                    return 'Leve 1/1/; ' . ++$a;
                },
                2 => function ($a) {
                    return 'Level 1/2: ' . ++$a;
                },
            ];
        },
        2 => function () {
            return [
                1 => function ($a) {
                    return 'Level 2/1 : ' . ++$a;
                },
                2 => function ($a) {
                    return 'Level 2/2 : ' . ++$a;
                }
            ];
        }
    ];
}
$a = 't';
$t = 'test';
$b = 'd';
$d = 'body';
echo $$b;
echo $$a()[1]()[2](100);


$test = [1, 2, 3];
$testb = &$test;
foreach ($test as $v) {
    printf("%2d\n", $v);
    unset($test[1]);
}

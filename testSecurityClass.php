<?php


require __DIR__ . '/Loader.php';
\Autoload\Loader::init(__DIR__ . '/..');
$security = new SecurityClass();
$data = [
    '<ul><li>Lots</li><li>of</li><li>Tags</li></ul>',
    12345,
    'This is a string',
    'String with number 12345',

];
foreach ($data as $item) {
    echo 'ORGINAL : ' . $item . '<br>';
    echo 'FILTERING'  . '<br>';
    printf('%12s : %s ' . '<br>', 'Strip Tags' , $security->filterStripTags($item));
    printf('%12s : %s ' . '<br>', 'Digits' , $security->filterDigits($item));
    printf('%12s : %s ' . '<br>', 'Alpha' , $security->filterAlpha($item));

    echo 'Validators' . '<br>';
    printf(
        '%12s : %s ' . '<br>',
        'Alnum',
        ($security->validateAlnum($item)) ? 'T' : 'F'
    );
    printf(
        '%12s : %s ' . '<br>',
        'Digits',
        ($security->validateDigits($item)) ? 'T' : 'F'
    );
    printf(
        '%12s : %s ' . '<br>',
        'Alpha',
        ($security->validateAlpha($item)) ? 'T' : 'F'
    );
}

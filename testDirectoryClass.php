<?php
define('EXAMPLE_PATH', realpath(__DIR__ . '/zend-validator'));
require __DIR__ . '/Loader.php';
\Autoload\Loader::init(__DIR__ . '/..');

$directory = new \Iterator\Directory(EXAMPLE_PATH);
echo EXAMPLE_PATH;
try {
    print_r($directory);
    echo 'Mimics  "ls -l -R" ' . PHP_EOL;
    foreach ($directory->ls('*.php') as $info) {
        echo $info;
    }
    echo 'Mimics "dir /s" ' . PHP_EOL;
    foreach ($directory->direct('*.php') as $info) {
        echo $info;
    }
} catch (\Throwable $th) {
    echo $th->getMessage();
}
// function someDirScan($dir)
// {
//     // uses "static" to retain value of $list
//     static $list = array();
//     // get a list of files and directories for this path
//     $list = glob($dir . DIRECTORY_SEPARATOR . '*');
//     // loop through
//     foreach ($list as $item) {
//         if (is_dir($item)) {
//             $list = array_merge($list, someDirScan($item));
//         }
//     }
//     return $list;
// }
// print_r(someDirScan(EXAMPLE_PATH));

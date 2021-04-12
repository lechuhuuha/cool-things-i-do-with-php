<?php

define("MASSIVE_FILE", './largeFile.txt');
define('CSV_FILE', './testCsv.csv');

require __DIR__ . '/Loader.php';
\Autoload\Loader::init(__DIR__ . '/..');

try {
    $largeFile = new LargeFile(__DIR__ . CSV_FILE);
    $iterator = $largeFile->getIterator('Csv');
    $words = 0;
    foreach ($iterator as $line) {
        echo ($line);
        $words += str_word_count($line);
    }
    echo str_repeat('-', 52) . PHP_EOL;
    printf("%-40s : %8d\n  ", 'Total Words', $words);
    printf("%-40s : %8d\n  ", 'Avarage Words Per Line', ($words / $iterator->getReturn()));
    echo str_repeat('-', 52) . PHP_EOL;
} catch (\Throwable $th) {
    echo $th->getMessage();
}

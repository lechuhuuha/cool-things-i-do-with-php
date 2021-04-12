<?php
define('DB_CONFIG_FILE', './db.config.php');
define('CSV_FILE', './testCsv.csv');
define('CSV_FILE_PROP', './prospects.csv');
require __DIR__ . '/Loader.php';
\Autoload\Loader::init(__DIR__ . '/..');

try {
    $connection = new Connection(include __DIR__ . DB_CONFIG_FILE);
    $largeFile = new LargeFile(__DIR__ . CSV_FILE);
    $iterator = $largeFile->getIterator('Csv');
    // $sql = 'INSERT INTO `prospects` '
    //     .
    //     '(`id`,`first_name`,`last_name`,`address`,`city`,`state_province`,'
    //     .
    //     '`postal_code`,`phone`,`country`,`email`,`status`,`budget`,`last_updated`) '
    //     . ' VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
    $sql = 'INSERT INTO `test_prospects`'
        .
        '(`chapter_number`,`software_r_v`,`free_or_not`,`dowload_link`,`file`,'
        .
        '`hardware`,`OS`)'
        . ' VALUES (?,?,?,?,?,?,?)';
    $statement = $connection->pdo->prepare($sql);
    print_r($statement);
    echo '<br>';
    $i = 0;
    foreach ($iterator as $row) {
        foreach ($row as $key => $value) {
            if (empty($row[$key])) {
                unset($row[$key]);
            }
        };
        echo implode(',', $row) . PHP_EOL;
        echo '<br>';
        $statement->execute($row);
    }
} catch (\Throwable $th) {
    echo $th->getMessage();
}

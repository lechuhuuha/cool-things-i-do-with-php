<?php
define('LOG_FILES', '/xampp/apache/logs/access.log');

require __DIR__ . '/Loader.php';
\Autoload\Loader::init(__DIR__ . '/..');

$freg = function ($line) {
    $ip = $this->getIp($line);
    if ($ip) {
        echo '.';
        $this->frequency[$ip] = (isset($this->frequency[$ip])) ? $this->frequency[$ip] + 1 : 1;
    }
};

foreach (glob(LOG_FILES) as $filename) {
    echo PHP_EOL . $filename . PHP_EOL;

    $access = new Access($filename);
    foreach ($access->fileIratorByLine() as $line) {
        $freg->call($access, $line);
    }
}

arsort($access->frequency);
foreach ($access->frequency as $key => $value) {
    printf('%16s : %6d' . PHP_EOL, $key, $value);
}

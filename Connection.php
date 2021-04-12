<?php

class Connection
{
    const ERROR_UNABLE = "ERROR : UNABLE TO CREATE DATABASE CONNECTION";
    public $pdo;
    public function __construct(array $config)
    {
        if (!isset($config['driver'])) {
            $message = __METHOD__ . ' : ' . self::ERROR_UNABLE . PHP_EOL;
            throw new Exception($message);
        }
        $dsn = $config['driver']
            . ':host=' . $config['host']
            . ';dbname=' . $config['dbname'];
        try {
            $this->pdo = new PDO($dsn, $config['user'], $config['password'], [PDO::ATTR_ERRMODE => $config['errmode']]);
        } catch (\Throwable $th) {
            echo ($th->getMessage());
            echo $th->getLine();
            echo $th->getFile();
        }
    }
}

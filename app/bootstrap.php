<?php
// Autoload minimal (manual)
spl_autoload_register(function($class){
    $base = __DIR__ . '/';
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . '/' . substr($class, 4) . '.php'; // assume App\ namespace
    if (file_exists($file)) require $file;
});

function e($v){ return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }

$config = require __DIR__ . '/../config.php';

try {
    $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4";
    $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $ex) {
    die('DB connection failed: ' . $ex->getMessage());
}

global $pdo;

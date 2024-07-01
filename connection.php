﻿<?php

// DB credentials.
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', '');
if (!defined('DB_NAME')) define('DB_NAME', 'shop_db');

// Estabelecer conexão com o banco de dados.
if (!defined('CURRENCY')) define('CURRENCY', 'Rs');

try {
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Define o modo de erro do PDO para exceções.
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

?>

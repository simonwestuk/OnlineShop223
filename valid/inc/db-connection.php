<?php

    require_once './inc/functions.php';
   
    $host = '127.0.0.1';
    $dbname = 'shop';
    $port ='3306';
    $charset = 'latin1';
    $driver = 'mysql';

    $username = 'root';
    $password = '';

    $dsn = "$driver:host=$host;dbname=$dbname;port=$port;charset=$charset"; //Data Source Name

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //When error occurs throw exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //Default that the DB returns key/value pairs (associative array)
        PDO::ATTR_EMULATE_PREPARES => false, //Allows the DB to return ints and not convert everything to a string
    ];

    try {
        
        $pdo = new PDO($dsn, $username, $password, $options);

    } catch (PDOException $e) {

        throw new PDOException($e -> getMessage(), (int)$e -> getCode());

    }
    
    
?>
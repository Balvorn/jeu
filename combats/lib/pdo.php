<?php

$host = 'localhost';
$dbname='jeu';
$user = 'root';
$pwd = '';
$locale= "";



$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8';

$pdo = new PDO($dsn, $user, $pwd,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION       ]);
    //    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);


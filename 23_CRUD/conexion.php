<?php

    require "../config.php";

    try {
        $db_connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        
        $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db_connection->exec("SET CHARACTER SET utf8");
        
    } catch(Exception $e) {
        echo $e->getMessage();
    }

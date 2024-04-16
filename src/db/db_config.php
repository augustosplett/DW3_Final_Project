<?php
    // db_config.php - Augusto Splett
    $host = 'localhost'; 
    $port = '3306';
    $username = 'root';
    $password = '123'; //erase or change for you password
    $database = 'kidsGames'; 

    // Create connection
    $conn = new mysqli($host, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

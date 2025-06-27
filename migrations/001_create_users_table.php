<?php

require_once "../connection/connection.php";

$query = "CREATE TABLE IF NOT EXISTS users(
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            username varchar(255) NOT NULL,
            email varchar(255) UNIQUE NOT NULL,
            password_hash varchar(255) NOT NULL,
            phone varchar(255) UNIQUE,
            is_admin TINYINT(1) DEFAULT 0,
            age INT
)";
$mysqli->query($query);

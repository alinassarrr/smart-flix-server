<?php

require_once("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS actors(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        profile VARCHAR(255)           
        )";
$mysqli->query($query);

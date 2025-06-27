<?php

require_once("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS movies(
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description VARCHAR(255),
            cover_image VARCHAR(255),
            trailer_url VARCHAR(255),
            rating VARCHAR(10),
            release_date DATE,
            duration INT
)";
$mysqli->query($query);

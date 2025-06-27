<?php
require_once("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS auditoriums(
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL
)";

$mysqli->query($query);
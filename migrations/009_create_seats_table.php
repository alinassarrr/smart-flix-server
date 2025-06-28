<?php
require_once("../connection/connection.php");
$query = "CREATE TABLE IF NOT EXISTS seats(
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            row INT(11) NOT NULL,
            number INT(11) NOT NULL,
            availability ENUM('available','reserved') DEFAULT 'available',
            auditorium_id INT(11) NOT NULL,
            FOREIGN KEY (auditorium_id) REFERENCES auditoriums(id) ON DELETE CASCADE
)";

$mysqli->query($query);
<?php
require_once("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS shows(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        startTime TIMESTAMP NOT NULL,
        price DECIMAL(4,2) NOT NULL,
        auditorium_id INT(11) NOT NULL,
        movie_id INT(11) NOT NULL,
        FOREIGN KEY (auditorium_id) REFERENCES auditoriums(id),
        FOREIGN KEY (movie_id) REFERENCES movies(id)
)";

$mysqli->query($query);
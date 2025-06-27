<?php

require_once("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS movie_categories(
        movie_id INT(11) NOT NULL,
        category_id INT(11) NOT NULL,
        PRIMARY KEY (movie_id,category_id),
        FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
)";
$mysqli->query($query);

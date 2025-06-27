<?php

require_once("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS movie_actors(
    movie_id INT(11) NOT NULL,
    actor_id INT(11) NOT NULL,
    PRIMARY KEY (movie_id,actor_id),
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
    FOREIGN KEY (actor_id) REFERENCES actors(id) ON DELETE CASCADE
)";
$mysqli->query($query);

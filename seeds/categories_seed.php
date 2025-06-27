<?php
require_once("../connection/connection.php");

$categories = [
    'Animation',
    'Comedy',
    'Crime',
    'Documentary',
    'Drama',
    'Horror',
    'Music',
    'Romance',
    'Sci-Fi'
];

foreach ($categories as $c) {
    $query = $mysqli->prepare('INSERT IGNORE INTO categories (name) VALUES (?)');
    $query->bind_param("s", $c);
    $query->execute();
}

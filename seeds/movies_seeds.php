<?php
require_once("../connection/connection.php");

$movies = [
    [
        "title" => "The Dark Knight",
        "description" => "Batman faces the Joker, a criminal mastermind who plunges Gotham into chaos.",
        "cover_image" => "/assets/images/movies/the_dark_knight.avif",
        "trailer_url" => "https://www.youtube.com/watch?v=EXeTwQWrcwY",
        "rating" => "PG-13",
        "release_date" => "2008-07-18",
        "duration" => 152
    ],
];

$query = "INSERT INTO movies (title, description, cover_image, trailer_url, rating, release_date, duration) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare(query: $query);
if ($stmt) {
    $stmt->bind_param(
        "ssssssi",
        $movies[0]["title"],
        $movies[0]["description"],
        $movies[0]["cover_image"],
        $movies[0]["trailer_url"],
        $movies[0]["rating"],
        $movies[0]["release_date"],
        $movies[0]["duration"]
    );
    $stmt->execute();
    $stmt->close();
    echo "Movie seeded successfully.";
} else {
    echo "Error: " . $mysqli->error;
}
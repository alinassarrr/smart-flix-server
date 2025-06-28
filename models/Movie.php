<?php

require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/Model.php");
class Movie extends Model
{
    private int $id;
    private string $title;
    private string $description;
    private string $cover_image;
    private string $trailer_url;
    private string $rating;
    private string $release_date;
    private int $duration;

    protected static string $table = "movies";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->description = $data["description"];
        $this->cover_image = $data["cover_image"];
        $this->trailer_url = $data["trailer_url"];
        $this->rating = $data["rating"];
        $this->release_date = $data["release_date"];
        $this->duration = $data["duration"];
    }
    // getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function getCoverImage(): string
    {
        return $this->cover_image;
    }
    public function getTrailerUrl(): string
    {
        return $this->trailer_url;
    }
    public function getRating(): string
    {
        return $this->rating;
    }
    public function getReleaseDate(): string
    {
        return $this->release_date;
    }
    public function getDuration(): int
    {
        return $this->duration;
    }
    // setters
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function setCoverImage(string $cover_image): void
    {
        $this->cover_image = $cover_image;
    }
    public function setTrailerUrl(string $trailer_url): void
    {
        $this->trailer_url = $trailer_url;
    }
    public function setRating(string $rating): void
    {
        $this->rating = $rating;
    }
    public function setReleaseDate(string $release_date): void
    {
        $this->release_date = $release_date;
    }
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function toArray()
    {
        return [$this->id, $this->title, $this->description, $this->cover_image, $this->trailer_url, $this->rating, $this->release_date, $this->duration];
    }
}
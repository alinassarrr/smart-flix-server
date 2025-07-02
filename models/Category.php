<?php

require_once(__DIR__ . "/Model.php");
require_once(__DIR__ . "/../connection/connection.php");

class Category extends Model
{
    private int $id;
    private string $name;

    protected static string $table = "categories";

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function toArray()
    {
        return ["id" => $this->id, "name" => $this->name];
    }

    public static function getMovieCategory(mysqli $mysqli,int $movieId){
        $query = "SELECT c.id,c.name  FROM categories c JOIN movie_categories mc ON c.id = mc.category_id WHERE mc.movie_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $movieId);
        $stmt->execute();
        $result = $stmt->get_result();
        $categories = [];
        while($row = $result->fetch_assoc()){
            $categories[] =$row;
        }
        
        return $categories;
    }
    


}
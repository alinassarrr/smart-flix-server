<?php

require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/Model.php");
class Show extends Model
{
   
    private int $id;
    private string $startTime;
    private float $price;
    private int $auditorium_id;
    private int $movie_id;
    protected static string $table = "shows";

    public function __construct(array $data)
    {
        $this->id= $data["id"];
        $this->startTime = $data["startTime"];
        $this->price = $data["price"];
        $this->auditorium_id = $data["auditorium_id"];
        $this->movie_id = $data["movie_id"];
       
    }
    // getters
    public function getId(): int
    {
        return $this->id;
    }
public function getStartTime(): string{
    return $this->startTime;
}
    public function getPrice():float{
        return $this->price;
    }
    public function getauditoriumId(): int{
        return $this->auditorium_id;
    }
    public function getMovieId(): int{
        return $this->movie_id;
    }

    public function setId(int $id): void{
        $this->id=$id;
    }
    public function setStartTime(string $startTime): void{
        $this->startTime=$startTime;
    }
    public function setPrice(float $price): void{
        $this->price=$price;
    }
    public function setauditoriumId(int $auditorium_id): void{
        $this->auditorium_id=$auditorium_id;
    }
    public function setMovieId(int $movie_id): void{
        $this->movie_id=$movie_id;
    }
    public function toArray()
{
    return [
    "id" => $this->id,
    "startTime" => $this->startTime,
    "price" => $this->price,
    "auditorium_id" => $this->auditorium_id,
    "movie_id" => $this->movie_id
    ];
}
    public static function findByDate(mysqli $mysqli, string $date ):array{
        $query = "SELECT * FROM shows WHERE show_date = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $shows[] = new Show($row);
            }
            return $shows;
        }
        return [];
    }
    public static function todayShowsNum( mysqli $mysqli ,string $date):int{
        $query = "SELECT COUNT(id) FROM shows WHERE show_date = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param( "s", $date);
        $stmt->execute();
        $result = $stmt->get_result(); // returnd key =>
        $row = $result->fetch_assoc();
        return $row["COUNT(id)"];
    }

}
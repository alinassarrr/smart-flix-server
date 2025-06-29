<?php
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/Model.php");

class Seat extends Model
{
    private int $id;
    private int $row;
    private int $number;
    private string $availability;

    private int $auditorium_id;

    protected static string $table = "seats";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->row = $data["row"];
        $this->number = $data["number"];
        $this->availability = $data["availability"];
        $this->auditorium_id = $data["auditorium_id"];
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getRow(): int
    {
        return $this->row;
    }
    public function getNumber(): int
    {
        return $this->number;
    }
    public function getAvailability(): string
    {
        return $this->availability;
    }
    public function getAuditoriumId(): int
    {
        return $this->auditorium_id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setRow(int $row): void
    {
        $this->row = $row;
    }
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }
    public function setAvailability(string $availability): void
    {
        $this->availability = $availability;
    }

    public function setAuditoriumId(int $auditorium_id): void
    {
        $this->auditorium_id = $auditorium_id;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "row" => $this->row,
            "number" => $this->number,
            "availability" => $this->availability,
            "auditorium_id" => $this->auditorium_id,

        ];
    }

    public function updateAvailability(mysqli $mysqli, string $availability, int $auditorium_id): bool
    {
        $query = "UPDATE seats SET availability = ? WHERE auditorium_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("si", $availability, $auditorium_id);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }
}
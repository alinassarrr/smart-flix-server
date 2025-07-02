<?php

require_once(__DIR__ . "/Model.php");
require_once(__DIR__ . "/../connection/connection.php");

class Auditorium extends Model
{
    private int $id;
    private string $name;

    protected static string $table = "auditoriums";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->name = $data["name"];
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
  
}
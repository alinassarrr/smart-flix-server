<?php

require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/Model.php");

class User extends Model
{
    private int $id;
    private string $username;
    private string $email;
    private string $password_hash;
    private string $phone;
    private int $is_admin;
    private int $age;

    protected static string $table = "users";
    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->email = $data["email"];
        $this->password_hash = $data["password_hash"];
        $this->phone = $data["phone"];
        $this->is_admin = $data["is_admin"];
        $this->age = $data["age"];
    }
    // getters and setters 
    public function getId(): int
    {
        return $this->id;
    }
    public function getUsername(): string
    {
        return $this->username;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }
    public function isAdmin(): int
    {
        return $this->is_admin;
    }
    public function getAge(): int
    {
        return $this->age;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setPasswordHash(string $password_hash)
    {
        $this->password_hash = $password_hash;
    }
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }
    public function setAdmin(int $admin)
    {
        $this->admin = $admin;
    }
    public function setAge(int $age)
    {
        $this->age = $age;
    }



}
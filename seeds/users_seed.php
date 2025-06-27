<?php

require_once("../connection/connection.php");

$users = [
    [
        "username" => "joe",
        "email" => "joe@gmail.com",
        "password" => password_hash("joe123", PASSWORD_DEFAULT),
        "phone" => "70123123",
        "is_admin" => 0,
        "age" => 29
    ],
    [
        "username" => "charbel",
        "email" => "charbel@gmail.com",
        "password" => password_hash("admin123", PASSWORD_DEFAULT),
        "phone" => "81123123",
        "is_admin" => 1,
        "age" => 28
    ],
    [
        "username" => "taha",
        "email" => "taha@gmail.com",
        "password" => password_hash("taha123", PASSWORD_DEFAULT),
        "phone" => "71123123",
        "is_admin" => 0,
        "age" => 25
    ],
    [
        "username" => "nour",
        "email" => "nour@gmail.com",
        "password" => password_hash("nour123", PASSWORD_DEFAULT),
        "phone" => "03123123",
        "is_admin" => 0,
        "age" => 27
    ],
    [
        "username" => "gheeda",
        "email" => "gheeda@gmail.com",
        "password" => password_hash("gheeda123", PASSWORD_DEFAULT),
        "phone" => "76123123",
        "is_admin" => 0,
        "age" => 26
    ]
];

$query = "INSERT IGNORE INTO users (username, email, password_hash, phone, is_admin, age) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);

if ($stmt) {
    foreach ($users as $user) {
        $stmt->bind_param(
            "ssssii",
            $user["username"],
            $user["email"],
            $user["password"],
            $user["phone"],
            $user["is_admin"],
            $user["age"]
        );
        $stmt->execute();
    }
    $stmt->close();
    echo "Users seeded successfully.";
} else {
    echo "Error: " . $mysqli->error;
}
<?php

require_once("../connection/connection.php");

$query = "CREATE TABLE IF NOT EXISTS bookings(
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            total_price DECIMAL(4,2) NOT NULL,
            user_id INT(11) NOT NULL,
            show_id INT(11) NOT NULL,
            seat_id INT(11) NOT NULL,
            booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (show_id) REFERENCES shows(id),
            FOREIGN KEY (seat_id) REFERENCES seats(id)
)";

$mysqli->query($query);
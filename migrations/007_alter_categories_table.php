<?php

require_once("../connection/connection.php");

$query = "ALTER TABLE categories ADD UNIQUE(name)";
$mysqli->query($query);
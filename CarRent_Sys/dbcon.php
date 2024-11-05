<?php
// Connection to SQLite Database
$database = new SQLite3('car_rental_system.db');

// Check if the connection is successful
if(!$database) {
    die("Database connection failed.");
}

?>

<?php
$database = new SQLite3('car_rental_system.db');

// Get the customer ID from the query string
$id = $_GET['id'];

// Prepare delete query
$stmt = $database->prepare("DELETE FROM customers WHERE customer_id = ?");
$stmt->bindParam(1, $id, SQLITE3_INTEGER);
$stmt->execute();

// Redirect back to index
header("Location: index.php");
?>

<?php
// delete_car.php
$db = new SQLite3('db/car_rental.db');
$car_id = $_GET['id'];
$db->exec("DELETE FROM Cars WHERE car_id = $car_id");
header("Location: cars.php");
exit();
?>

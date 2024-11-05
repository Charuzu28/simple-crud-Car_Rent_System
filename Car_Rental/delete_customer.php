<?php
// delete_customer.php
$db = new SQLite3('db/car_rental.db');
$customer_id = $_GET['id'];
$db->exec("DELETE FROM Customers WHERE customer_id = $customer_id");
header("Location: customers.php");
exit();
?>

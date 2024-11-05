<?php
$database = new SQLite3('car_rental_system.db');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Prepare SQL query to insert data securely
    $stmt = $database->prepare("INSERT INTO customers (name, email, phone) VALUES (?, ?, ?)");
    $stmt->bindParam(1, $name, SQLITE3_TEXT);
    $stmt->bindParam(2, $email, SQLITE3_TEXT);
    $stmt->bindParam(3, $phone, SQLITE3_TEXT);
    $stmt->execute();

    // Redirect back to index
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Customer</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Add New Customer</h1>
    <form action="create.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter customer name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter customer email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter customer phone number" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Customer</button>
    </form>
</div>

<!-- Optional: Include Bootstrap JS for interactivity -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

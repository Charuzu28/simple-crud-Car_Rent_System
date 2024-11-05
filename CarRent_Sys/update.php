<?php
$database = new SQLite3('car_rental_system.db');

// Fetch existing customer data if ID is provided
$id = $_GET['id'];
$query = $database->prepare("SELECT * FROM customers WHERE customer_id = ?");
$query->bindParam(1, $id, SQLITE3_INTEGER);
$result = $query->execute()->fetchArray(SQLITE3_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update the record securely using prepared statements
    $stmt = $database->prepare("UPDATE customers SET name = ?, email = ?, phone = ? WHERE customer_id = ?");
    $stmt->bindParam(1, $name, SQLITE3_TEXT);
    $stmt->bindParam(2, $email, SQLITE3_TEXT);
    $stmt->bindParam(3, $phone, SQLITE3_TEXT);
    $stmt->bindParam(4, $id, SQLITE3_INTEGER);
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
    <title>Edit Customer</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Customer</h1>
    <form action="update.php?id=<?php echo $id; ?>" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $result['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $result['phone']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Customer</button>
    </form>
</div>

<!-- Optional: Include Bootstrap JS for interactivity -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


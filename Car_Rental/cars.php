<?php
// cars.php
$db = new SQLite3('db/car_rental.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $registration_number = $_POST['registration_number'];
    $rental_rate = $_POST['rental_rate'];

    $stmt = $db->prepare("INSERT INTO Cars (brand, model, year, registration_number, rental_rate) 
                          VALUES (:brand, :model, :year, :registration_number, :rental_rate)");
    $stmt->bindValue(':brand', $brand, SQLITE3_TEXT);
    $stmt->bindValue(':model', $model, SQLITE3_TEXT);
    $stmt->bindValue(':year', $year, SQLITE3_INTEGER);
    $stmt->bindValue(':registration_number', $registration_number, SQLITE3_TEXT);
    $stmt->bindValue(':rental_rate', $rental_rate, SQLITE3_FLOAT);
    $stmt->execute();
    header("Location: cars.php");
    exit();
}

$cars = $db->query("SELECT * FROM Cars");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cars - Car Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Car Management</h1>
    <form method="POST" class="mb-4 p-4 border rounded bg-light">
        <h3>Add New Car</h3>
        <div class="mb-3"><label>Brand</label><input type="text" name="brand" class="form-control" required></div>
        <div class="mb-3"><label>Model</label><input type="text" name="model" class="form-control" required></div>
        <div class="mb-3"><label>Year</label><input type="number" name="year" class="form-control" required></div>
        <div class="mb-3"><label>Registration Number</label><input type="text" name="registration_number" class="form-control" required></div>
        <div class="mb-3"><label>Rental Rate (per day)</label><input type="number" step="0.01" name="rental_rate" class="form-control" required></div>
        <button type="submit" class="btn btn-primary">Add Car</button>
    </form>

    <h3>Car List</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Year</th>
            <th>Registration Number</th>
            <th>Rental Rate</th>
            <th>Availability</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($car = $cars->fetchArray()): ?>
            <tr>
                <td><?= $car['car_id'] ?></td>
                <td><?= htmlspecialchars($car['brand']) ?></td>
                <td><?= htmlspecialchars($car['model']) ?></td>
                <td><?= htmlspecialchars($car['year']) ?></td>
                <td><?= htmlspecialchars($car['registration_number']) ?></td>
                <td><?= htmlspecialchars($car['rental_rate']) ?></td>
                <td><?= $car['availability_status'] ? 'Available' : 'Unavailable' ?></td>
                <td>
                    <a href="edit_car.php?id=<?= $car['car_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete_car.php?id=<?= $car['car_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

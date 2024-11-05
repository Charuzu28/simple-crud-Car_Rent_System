<?php
// edit_car.php
$db = new SQLite3('db/car_rental.db');
$car_id = $_GET['id'];
$car = $db->querySingle("SELECT * FROM Cars WHERE car_id = $car_id", true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $registration_number = $_POST['registration_number'];
    $rental_rate = $_POST['rental_rate'];
    $availability_status = isset($_POST['availability_status']) ? 1 : 0;

    $stmt = $db->prepare("UPDATE Cars SET brand = :brand, model = :model, year = :year, 
                          registration_number = :registration_number, rental_rate = :rental_rate, 
                          availability_status = :availability_status WHERE car_id = :car_id");
    $stmt->bindValue(':brand', $brand, SQLITE3_TEXT);
    $stmt->bindValue(':model', $model, SQLITE3_TEXT);
    $stmt->bindValue(':year', $year, SQLITE3_INTEGER);
    $stmt->bindValue(':registration_number', $registration_number, SQLITE3_TEXT);
    $stmt->bindValue(':rental_rate', $rental_rate, SQLITE3_FLOAT);
    $stmt->bindValue(':availability_status', $availability_status, SQLITE3_INTEGER);
    $stmt->bindValue(':car_id', $car_id, SQLITE3_INTEGER);
    $stmt->execute();
    header("Location: cars.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Car</h1>
    <form method="POST">
        <div class="mb-3"><label>Brand</label><input type="text" name="brand" class="form-control" value="<?= htmlspecialchars($car['brand']) ?>" required></div>
        <div class="mb-3"><label>Model</label><input type="text" name="model" class="form-control" value="<?= htmlspecialchars($car['model']) ?>" required></div>
        <div class="mb-3"><label>Year</label><input type="number" name="year" class="form-control" value="<?= htmlspecialchars($car['year']) ?>" required></div>
        <div class="mb-3"><label>Registration Number</label><input type="text" name="registration_number" class="form-control" value="<?= htmlspecialchars($car['registration_number']) ?>" required></div>
        <div class="mb-3"><label>Rental Rate</label><input type="number" step="0.01" name="rental_rate" class="form-control" value="<?= htmlspecialchars($car['rental_rate']) ?>" required></div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="availability_status" class="form-check-input" <?= $car['availability_status'] ? 'checked' : '' ?>>
            <label class="form-check-label">Available</label>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="cars.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>

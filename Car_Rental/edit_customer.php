<?php
// edit_customer.php
$db = new SQLite3('db/car_rental.db');
$customer_id = $_GET['id'];
$customer = $db->querySingle("SELECT * FROM Customers WHERE customer_id = $customer_id", true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $license_number = $_POST['license_number'];

    $stmt = $db->prepare("UPDATE Customers SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, 
                          address = :address, license_number = :license_number WHERE customer_id = :customer_id");
    $stmt->bindValue(':first_name', $first_name, SQLITE3_TEXT);
    $stmt->bindValue(':last_name', $last_name, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
    $stmt->bindValue(':address', $address, SQLITE3_TEXT);
    $stmt->bindValue(':license_number', $license_number, SQLITE3_TEXT);
    $stmt->bindValue(':customer_id', $customer_id, SQLITE3_INTEGER);
    $stmt->execute();
    header("Location: customers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Customer</h1>
    <form method="POST">
        <div class="mb-3"><label>First Name</label><input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($customer['first_name']) ?>" required></div>
        <div class="mb-3"><label>Last Name</label><input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($customer['last_name']) ?>" required></div>
        <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" value="<?= htmlspecialchars($customer['email']) ?>" required></div>
        <div class="mb-3"><label>Phone</label><input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($customer['phone']) ?>"></div>
        <div class="mb-3"><label>Address</label><textarea name="address" class="form-control"><?= htmlspecialchars($customer['address']) ?></textarea></div>
        <div class="mb-3"><label>License Number</label><input type="text" name="license_number" class="form-control" value="<?= htmlspecialchars($customer['license_number']) ?>" required></div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="customers.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>

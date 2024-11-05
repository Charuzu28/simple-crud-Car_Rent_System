<?php
// customers.php
$db = new SQLite3('db/car_rental.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $license_number = $_POST['license_number'];

    $stmt = $db->prepare("INSERT INTO Customers (first_name, last_name, email, phone, address, license_number) 
                          VALUES (:first_name, :last_name, :email, :phone, :address, :license_number)");
    $stmt->bindValue(':first_name', $first_name, SQLITE3_TEXT);
    $stmt->bindValue(':last_name', $last_name, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
    $stmt->bindValue(':address', $address, SQLITE3_TEXT);
    $stmt->bindValue(':license_number', $license_number, SQLITE3_TEXT);
    $stmt->execute();
    header("Location: customers.php");
    exit();
}

$customers = $db->query("SELECT * FROM Customers");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers - Car Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Customer Management</h1>
    <form method="POST" class="mb-4 p-4 border rounded bg-light">
        <h3>Add New Customer</h3>
        <div class="mb-3"><label>First Name</label><input type="text" name="first_name" class="form-control" required></div>
        <div class="mb-3"><label>Last Name</label><input type="text" name="last_name" class="form-control" required></div>
        <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
        <div class="mb-3"><label>Phone</label><input type="text" name="phone" class="form-control"></div>
        <div class="mb-3"><label>Address</label><textarea name="address" class="form-control"></textarea></div>
        <div class="mb-3"><label>License Number</label><input type="text" name="license_number" class="form-control" required></div>
        <button type="submit" class="btn btn-primary">Add Customer</button>
    </form>

    <h3>Customer List</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>License Number</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($customer = $customers->fetchArray()): ?>
            <tr>
                <td><?= $customer['customer_id'] ?></td>
                <td><?= htmlspecialchars($customer['first_name']) ?></td>
                <td><?= htmlspecialchars($customer['last_name']) ?></td>
                <td><?= htmlspecialchars($customer['email']) ?></td>
                <td><?= htmlspecialchars($customer['phone']) ?></td>
                <td><?= htmlspecialchars($customer['license_number']) ?></td>
                <td>
                    <a href="edit_customer.php?id=<?= $customer['customer_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete_customer.php?id=<?= $customer['customer_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

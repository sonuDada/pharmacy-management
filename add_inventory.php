<?php
// Include database connection
$conn = new mysqli("localhost", "root", "", "pharmacy");

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    die("Connection failed" . $conn->connect_error);
}

// Get form data
$company = $_POST['company'];
$name = $_POST['name'];
$batch_number = $_POST['batch_number'];
$price_per_unit = $_POST['price_per_unit'];
$quantity = $_POST['quantity'];
$remaining_quantity = $_POST['remaining_quantity'];

// Insert data into inventory table
$sql = "INSERT INTO inventory (company, name, batch_number, price_per_unit, quantity, remaining_quantity) VALUES ('$company', '$name', '$batch_number', '$price_per_unit', '$quantity', '$remaining_quantity')";

if (mysqli_query($conn, $sql)) {
    // Redirect to success page or display a success message
    echo "<script>alert('Inventory item added successfully!');</script>";
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
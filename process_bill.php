<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bills.css">
</head>
<body>

<?php
// Include database connection
$conn = new mysqli("localhost", "root", "", "pharmacy");

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    die("Connection failed" . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_name = $_POST["customer_name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $medicine = $_POST["medicine"];
    $quantity = $_POST["quantity"];

    // Debugging: Print the value of $medicine

    // Retrieve price per unit from inventory table
    $sql = "SELECT price_per_unit, remaining_quantity FROM inventory WHERE name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $medicine);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $price_per_unit, $remaining_quantity);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Calculate total bill amount
    $total_bill = $price_per_unit * $quantity;

    // Save bill details in database
    $sql = "INSERT INTO bills (customer_name, address, phone, medicine, purchase_quantity, total_bill) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssdi", $customer_name, $address, $phone, $medicine, $quantity, $total_bill);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Update remaining quantity of medicine in inventory table
    $new_remaining_quantity = $remaining_quantity - $quantity;
    $sql = "UPDATE inventory SET remaining_quantity = ? WHERE name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "is", $new_remaining_quantity, $medicine);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Close database connection
    mysqli_close($conn);

    // Redirect to a success page or display a success message
    echo "<script>alert('Bill generated successfully! Total amount: $total_bill');</script>";
    // You can redirect to another page after the bill is generated
    // header("Location: success_page.php");
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: generate_bill.php");
}
?>


 <div class="bill-container">
        <h2>Bill Details</h2>
        <table class="bill-table">
            <tr>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Medicine Name</th>
                <th>Purchase Quantity</th>
                <th>Total Bill</th>
                <th>Bill Date</th>
            </tr>
            <tr>
                <td><?php echo $customer_name; ?></td>
                <td><?php echo $address; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $medicine; ?></td>
                <td><?php echo $quantity; ?></td>
                <td><?php echo $total_bill; ?></td>
                <td><?php echo date("h:i:sa") ?></td>
            </tr>
        </table>
    </div>

    
</body>
</html>

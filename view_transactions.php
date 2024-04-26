<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Billing Transactions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #007bff;
            color: white;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>View Billing Transactions</h1>
    <table>
        <tr>
            <th>Transaction ID</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Medicine Name</th>
            <th>Purchase Quantity</th>
            <th>Total Bill</th>
            <th>Billing Date</th>
        </tr>
        <?php
        // Include database connection
        $conn = new mysqli("localhost", "root", "", "pharmacy");

        // Retrieve all billing transactions from database
        $sql = "SELECT * FROM bills";
        $result = $conn->query($sql);

        // Check if there are any transactions
        if ($result->num_rows > 0) {
            // Loop through each row and display data in table
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['customer_name'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['medicine_name'] . "</td>";
                echo "<td>" . $row['purchase_quantity'] . "</td>";
                echo "<td>" . $row['total_bill'] . "</td>";
                echo "<td>" . $row['bill_date'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No billing transactions found.</td></tr>";
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
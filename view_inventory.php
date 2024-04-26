<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Inventory</title>
    <style>
        /* Styles for view inventory page */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

thead {
    background-color: #007bff;
    color: #fff;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ccc;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Inventory Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Name</th>
                    <th>Batch Number</th>
                    <th>Price per Unit</th>
                    <th>Quantity</th>
                    <th>Remaining Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection
                $conn = new mysqli("localhost", "root", "", "pharmacy");

                if ($conn->connect_error) {
                    echo "Connection failed: " . $conn->connect_error;
                    die("Connection failed" . $conn->connect_error);
                }

                // Fetch data from inventory table
                $sql = "SELECT * FROM inventory";
                $result = $conn->query($sql);

                // Check if there are any rows returned
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["company"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["batch_number"] . "</td>";
                        echo "<td>" . $row["price_per_unit"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>" . $row["remaining_quantity"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No inventory items found.</td></tr>";
                }

                // Close database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

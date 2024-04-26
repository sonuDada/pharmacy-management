<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Bill</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family :'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f2f2f2;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: grid;
    gap: 7px;
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button[type="submit"] {
    width: 100%;
    padding: 15px;
    background-color: #007bff;
    font-size: large;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Generate Bill</h2>
        <form action="process_bill.php" method="post">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required><br>

            <label for="medicine">Medicine:</label>
            <select id="medicine" name="medicine" required>
                <?php
                // Include database connection
                $conn = new mysqli("localhost", "root", "", "pharmacy");
                if ($conn->connect_error) {
                    echo "Connection failed: " . $conn->connect_error;
                    die("Connection failed" . $conn->connect_error);
                }

                // Fetch medicine names from database
                $sql = "SELECT name FROM inventory";
                $result = mysqli_query($conn, $sql);

                // Output options for select dropdown
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                }

                // Close database connection
                mysqli_close($conn);
                ?>
            </select><br>

            <label for="quantity">Purchase Quantity:</label>
            <input type="number" id="quantity" name="quantity" required><br>

            <button type="submit">Generate Bill</button>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Inventory Item</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Add Inventory Item</h2>
            <form action="add_inventory.php" method="post">
                <label for="company">Company:</label>
                <input type="text" id="company" name="company" required>
                
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="batch_number">Batch Number:</label>
                <input type="text" id="batch_number" name="batch_number" required>

                <label for="price_per_unit">Price per Unit:</label>
                <input type="number" id="price_per_unit" name="price_per_unit" required>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>

                <label for="remaining_quantity">Remaining Quantity:</label>
                <input type="number" id="remaining_quantity" name="remaining_quantity" required>

                <input type="submit" value="Add Inventory Item">
            </form>
        </div>
    </div>
</body>
</html>

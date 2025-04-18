<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Update Product</title>
    <link rel="stylesheet" href="addProduct.css">
</head>
<body>

<header>
    <?php include 'header.php'; ?>
</header>

<main class="container">
    <h2>Add/Update Product</h2>

    <div class="form-container">
        <form action="addProduct_action.php" method="POST">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" placeholder="Enter product name" required>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" placeholder="Enter price" required>

            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity" placeholder="Enter quantity" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="Enter description" required></textarea>

            <label for="stateName">State:</label>
            <input type="text" id="stateName" name="stateName" placeholder="Enter state name" required>

            <label for="imagePath">Image Path:</label>
            <input type="text" id="imagePath" name="imagePath" placeholder="Enter image path" required>

            <div id="save">
                <button type="submit" class="submit-button">Add Product</button>
            </div>
        </form>
    </div>
</main>

<footer>
    <?php include 'footer.php'; ?>
</footer>

</body>
</html>

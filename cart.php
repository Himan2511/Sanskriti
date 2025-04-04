<?php

include 'db_connection.php'; // Include the database connection file
include 'header.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Redirect to login if user is not logged in
if (!isset($_SESSION['ID'])) {
    header('Location: login.html');
    exit();
}

// Fetch Cart and Product data for a specific customer
$customer_id = $_SESSION['ID'];

$sql = "SELECT p.ID AS ProductID, p.Image, p.Description, p.Price, c.Quantity 
        FROM Cart c 
        JOIN Products p ON c.ProductID = p.ID 
        WHERE c.CustID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

$sql1 = "SELECT Street, City, State, Pincode FROM users WHERE ID = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("s", $customer_id);
$stmt1->execute();
$result1 = $stmt1->get_result();

$default_address = "";
if ($row = $result1->fetch_assoc()) {
    $default_address = $row['Street'] . ", " . $row['City'] . ", " . $row['State'] . ", " . $row['Pincode'];
}

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Calculate the total
$total = 0;
foreach ($products as $product) {
    $total += $product['Price'] * $product['Quantity'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="cart.css">
</head>
<body>

<div class="container my-5">
<h1 class="card-title">My Cart</h1>
    <div class="card my-4">
        <div class="card-body">
            
            
            <?php foreach ($products as $product): ?>
            <div class="product-item d-flex align-items-center mb-3">
                <img src="<?php echo htmlspecialchars($product['Image']); ?>" alt="Product Image" class="product-img mr-3">
                <div class="product-info mr-auto">
                    <p class="description mb-1"><?php echo htmlspecialchars($product['Description']); ?></p>
                    <div class="quantity-control d-flex align-items-center">
                        <button class="btn btn-sm btn-outline-secondary mr-2" onclick="updateQuantity('<?php echo $product['ProductID']; ?>', 'increment')">+</button>
                        <span class="quantity"><?php echo htmlspecialchars($product['Quantity']); ?></span>
                        <button class="btn btn-sm btn-outline-secondary ml-2" onclick="updateQuantity('<?php echo $product['ProductID']; ?>', 'decrement')">-</button>
                    </div>
                </div>
                <?php $product['Price']=$product['Price']*$product['Quantity'];?>
                <span class="price">$<?php echo htmlspecialchars(number_format($product['Price'], 2)); ?></span>
            </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-end align-items-center my-3">
                <span class="total-label mr-3">Total</span>
                <span class="total-amount">$<?php echo number_format($total, 2); ?></span>
            </div>

            <div class="form-group">
                 <input type="text" id="address" class="form-control" placeholder="Enter Address" value="<?php echo htmlspecialchars($default_address); ?>">
            </div>

            <button class="btn btn-primary btn-save" onclick="placeOrder()">BUY NOW</button>
        </div>
    </div>
</div>

<script>
// Function to update quantity
function updateQuantity(productId, action) {
    fetch('update_quantity.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ productId: productId, action: action })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Refresh page to show updated quantity
        } else {
            alert(data.message);
        }
    });
}

// Function to place an order
function placeOrder() {
    const address = document.getElementById('address').value;
    if (address.trim() === '') {
        alert("Please enter an address.");
        return;
    }

    fetch('place_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ address: address })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'order.php';
        } else {
            alert(data.message);
        }
    });
}
</script>
<?php include 'footer.php'; ?>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketPlace</title>
    <link rel="stylesheet" href="mart.css?ver=1.3">
</head>
<body>
    <?php
    session_start();
    include 'db_connection.php'; // Include the database connection file
    include 'header.php'; // Include the header file
    ?>

    <div class="banner-slider">
        <div class="slides-container" id="slidesContainer">
                <div class="slide">
                    <img src="https://via.placeholder.com/800x300?text=Slide+1" alt="Slide 1">
                    <div class="slide-content">
                        <h2>Welcome to Our Shop</h2>
                        <p>Discover amazing products and offers!</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="https://via.placeholder.com/800x300?text=Slide+1" alt="Slide 2">
                    <div class="slide-content">
                        <h2>Exclusive Deals</h2>
                        <p>Only for a limited time!</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="https://via.placeholder.com/800x300?text=Slide+1" alt="Slide 3">
                    <div class="slide-content">
                        <h2>Shop Local Art</h2>
                        <p>Support local artisans and artists.</p>
                    </div>
                </div>
            </div>
        
            <button class="slider-nav left" onclick="prevSlide()">&#10094;</button>
            <button class="slider-nav right" onclick="nextSlide()">&#10095;</button>
        
            <div class="pagination-dots" id="paginationDots">
                <span onclick="goToSlide(0)" class="dot active"></span>
                <span onclick="goToSlide(1)" class="dot"></span>
                <span onclick="goToSlide(2)" class="dot"></span>
            </div>
        </div>
    </div>

    <div class="region-select">
        <!-- Heading and Search Box -->
        <div class="header-container">
            <h2 class="region-heading">Search by State</h2>
            <div class="search-container">
                <input type="text" id="regionSearch" placeholder="Search for region...">
            </div>
        </div>
        <div class="region-section">
            <!-- Left Scroll Button -->
            <button class="scroll-button left" onclick="scrollLeft()">&#10094;</button>
            <!-- Regions Container -->
            <div class="regions-container" id="regionsContainer">
                <?php
                    // Query to get regions (states)
                    $sql = "SELECT Name FROM States";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="region-tile">' . htmlspecialchars($row["Name"]) . '</div>';
                        }
                    } else {
                        echo "No regions available.";
                    }
                ?>
            </div>
            <!-- Right Scroll Button -->
            <button class="scroll-button right" onclick="scrollRight()">&#10095;</button>
        </div>
    </div>

    <section class="products">
        <h2>Products</h2>
        <div class="product-grid">
            <?php
                // Fetch approved products
                $sql = "SELECT ID, Name, Description, Image, Price, Quantity FROM Products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="product-card">';
                        echo '<img src="' . htmlspecialchars($row["Image"]) . '" alt="Product Image">';
                        echo '<h3>' . htmlspecialchars($row["Name"]) . '</h3>';
                        echo '<p class="description">' . htmlspecialchars($row["Description"]) . '</p>';
                        echo '<p class="price">$' . htmlspecialchars($row["Price"]) . '</p>';
                        echo '<div class="quantity-selector">';
                        echo '<button class="decrement" onclick="updateQuantity(this, -1)">−</button>';
                        echo '<span class="quantity">1</span>';
                        echo '<button class="increment" onclick="updateQuantity(this, 1)">+</button>';
                        echo '</div>';
                        echo '<button class="add-to-cart">Add to Cart</button>';
                        echo '</div>';
                    }
                } else {
                    echo "No products available.";
                }
            ?>
        </div>
    </section>

    <section class="local-artist">
        <h2>Local Artist</h2>
        <div class="artist-grid">
            <div class="artist-card">
                <img src="https://via.placeholder.com/80" alt="Artist">
                <p>Artist Name</p>
                <p>Village</p>
            </div>
            <div class="artist-card">
                <img src="https://via.placeholder.com/80" alt="Artist">
                <p>Artist Name</p>
                <p>Village</p>
            </div>
            <!-- Add more artist cards as needed -->
        </div>
    </section>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <script src="mart.js?ver=1.4"></script>
</body>
</html>

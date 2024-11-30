<?php
session_start();

if (!isset($_SESSION["username"])) {
    // Gebruiker is niet ingelogd, dus doorsturen naar de loginpagina
    header("location: login.php");
    exit;
}

require_once "classes/Db.php";
require_once "classes/Product.php";

// Haal de database-verbinding op
$conn = Db::getConnection();

// Haal alle producten op
$products = Product::getAllProducts($conn);


//filteren op categorie
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';
if (!empty($selectedCategory)) {
    $products = Product::getProductsByCategory($conn, $selectedCategory);
} else {
    $products = Product::getAllProducts($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Welcome to the home page <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
    <a href="logout.php">Logout</a>

    <h2>Our Products</h2>
    <form method="GET" action="">
    <label for="options">Kies een categorie</label>
    <select name="category" id="options" onchange="this.form.submit()">
        <option value="">-- Alle Categorieën --</option>
        <option value="snowboard" <?php echo (isset($_GET['category']) && $_GET['category'] == 'snowboard') ? 'selected' : ''; ?>>Snowboard</option>
        <option value="ski" <?php echo (isset($_GET['category']) && $_GET['category'] == 'ski') ? 'selected' : ''; ?>>Ski</option>
        <option value="skate & longboard" <?php echo (isset($_GET['category']) && $_GET['category'] == 'skate & longboard') ? 'selected' : ''; ?>>Skate & Longboard</option>
        <option value="windsurf" <?php echo (isset($_GET['category']) && $_GET['category'] == 'windsurf') ? 'selected' : ''; ?>>Windsurf</option>
    </select>
</form>


    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product-item">
                <h3><?php echo htmlspecialchars($product->getName()); ?></h3>
                <p><?php echo htmlspecialchars($product->getDescription()); ?></p>
                <p>Category: <?php echo htmlspecialchars($product->getCategory()); ?></p>
                <p class="price" ><strong>Price: €<?php echo htmlspecialchars($product->getPrice()); ?></strong></p>
                <a href="product_details.php">View Product</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

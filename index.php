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
    <label for="cars">Kies een categorie</label>

    <select id="options">
    <option value="volvo">Snowboard</option>
    <option value="saab">Ski</option>
    <option value="opel">Skate & longboard</option>
    <option value="audi">Windsurf</option>
    </select>

    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product-item">
                <h3><?php echo htmlspecialchars($product->getName()); ?></h3>
                <p><?php echo htmlspecialchars($product->getDescription()); ?></p>
                <p>Category: <?php echo htmlspecialchars($product->getCategory()); ?></p>
                <p class="price" ><strong>Price: €<?php echo htmlspecialchars($product->getPrice()); ?></strong></p>
                <a href="<?php echo htmlspecialchars($product->getUrl()); ?>">View Product</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

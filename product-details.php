<?php
session_start();

include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/Add-to-cart.php");

$conn = Db::getConnection();

// Haal product ID op uit de URL
$p = isset($_GET['Id']) ? $_GET['Id'] : null;

if ($p) {
    // Geef product details op basis van het opgegeven product ID
    $sql = "SELECT * FROM products WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $p);
    $statement->execute();
    $product = $statement->fetch();
} else {
    echo "Geen product ID opgegeven!";
    exit;
}

// Verwerk formulier indien verzonden
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    if (isset($_SESSION['user_id'])) {
        try {
            $sqlInsert = "INSERT INTO cart (users_id, products_id) VALUES (:user_id, :products_id)";
            $statementInsert = $conn->prepare($sqlInsert);
            $statementInsert->bindValue(':user_id', $_SESSION['user_id']);
            $statementInsert->bindValue(':products_id', $_POST['product_id']);

            if ($statementInsert->execute()) {
                echo "<p>Product succesvol toegevoegd aan je winkelmand!</p>";
            } else {
                echo "<p>Er is een fout opgetreden bij het toevoegen van het product.</p>";
            }
        } catch (Exception $e) {
            echo "<p>Fout: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>Je moet eerst inloggen om een product aan je winkelmand toe te voegen!</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Product Details</h1>

    <?php if ($product): ?>
        <p>Product Naam: <?php echo htmlspecialchars($product['name']); ?></p>
        <p>Beschrijving: <?php echo htmlspecialchars($product['description']); ?></p>
        <p>Prijs: €<?php echo htmlspecialchars($product['price']); ?></p>
        <p>Categorie: <?php echo htmlspecialchars($product['category']); ?></p>
        <img src="<?php echo htmlspecialchars($product['url']); ?>" alt="Product afbeelding" style="max-width: 300px; height: auto;">

        <!-- Formulier om een product toe te voegen aan de winkelmand -->
        <form action="product-details.php?Id=<?php echo $product['id']; ?>" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <button type="submit">Voeg toe aan winkelmand</button>
        </form>

    <?php else: ?>
        <p>Product niet gevonden!</p>
    <?php endif; ?>

</body>
</html>

<?php
session_start();

include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/Add-to-cart.php");

$conn = Db::getConnection();
$user_id = $_SESSION['user_id'];

$p = $_GET['Id'];

// Haal productdetails op uit de database
$sql = "SELECT * FROM products WHERE id = :id";
$statement = $conn->prepare($sql);
$statement->bindParam(':id', $p);
$statement->execute();
$product = $statement->fetch();

$cart = new AddToCart($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    if (isset($_SESSION['user_id'])) {
        $product_id = $_POST['product_id'];

        if ($cart->addProductToCart($user_id, $product_id)) {
            echo "Product succesvol toegevoegd aan je winkelmand!";
        } else {
            echo "Dit product staat al in je winkelmand!";
        }
    } else {
        echo "Je moet eerst inloggen om een product aan je winkelmand toe te voegen!";
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

<?php
session_start();
include_once(__DIR__ . "/classes/Db.php");

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    echo "Je moet eerst inloggen om de winkelmand te bekijken!";
    exit;
}

$conn = Db::getConnection();
$user_id = $_SESSION['user_id'];

// Haal alle producten op die aan de winkelmand van de gebruiker zijn toegevoegd
$sql = "SELECT products.name, products.price FROM cart 
        JOIN products ON cart.products_id = products.id 
        WHERE cart.users_id = :user_id";
$statement = $conn->prepare($sql);
$statement->bindValue(':user_id', $user_id);
$statement->execute();

$products = $statement->fetchAll(PDO::FETCH_ASSOC);

// Bereken de totale prijs
$totalPrice = 0;
foreach ($products as $product) {
    $totalPrice += $product['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmand</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Je Winkelmand</h1>

<?php if (count($products) > 0): ?>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                Naam: <?php echo htmlspecialchars($product['name']); ?> - Prijs: €<?php echo htmlspecialchars($product['price']); ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <p><strong>Totale Prijs: €<?php echo number_format($totalPrice, 2); ?></strong></p>

<?php else: ?>
    <p>Je winkelmand is leeg.</p>
<?php endif; ?>

</body>
</html>

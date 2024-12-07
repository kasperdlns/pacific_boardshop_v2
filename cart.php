<?php
session_start();

include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/Add-to-cart.php");

$conn = Db::getConnection();
$user_id = $_SESSION['user_id'];

$cart = new AddToCart($conn);

// Product verwijderen uit de winkelmand
if (isset($_GET['remove_id'])) {
    $product_id = $_GET['remove_id'];
    if ($cart->removeProductFromCart($user_id, $product_id)) {
        echo "Product is succesvol verwijderd uit je winkelmand.";
        header('Location: cart.php');  // Redirect naar de cart-pagina om wijzigingen te zien
        exit;
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van het product.";
    }
}

// Producten ophalen uit de winkelmand voor weergave
$sql = "SELECT p.name, p.price, c.products_id FROM cart c JOIN products p ON c.products_id = p.id WHERE c.users_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();
$products = $stmt->fetchAll();

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

<h2>Je Winkelmand</h2>

<?php if (count($products) > 0): ?>
    <table>
        <tr>
            <th>Product Naam</th>
            <th>Prijs</th>
            <th>Actie</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td>€<?php echo htmlspecialchars($product['price']); ?></td>
                <td>
                    <a href="cart.php?remove_id=<?php echo $product['products_id']; ?>">Verwijderen</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Je winkelmand is leeg.</p>
<?php endif; ?>

</body>
</html>

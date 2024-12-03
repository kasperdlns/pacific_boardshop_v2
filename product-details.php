<?php     
    // db connection
    include_once(__dir__ . "/classes/Db.php");
    $conn = Db::getConnection();

    // geef product id
    $p = $_GET['Id'];

    // geef product details
    $sql = "SELECT * FROM products WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $p);
    $statement->execute();
    $product = $statement->fetch();  // Dit haalt de productgegevens op in een array
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
    <h1>Product details</h1>
    <p>Product name: <?php echo ($product['name']); ?></p>
    <p>Product description: <?php echo ($product['description']); ?></p>
    <p>Product price: €<?php echo ($product['price']); ?></p>
    <p>Product category: <?php echo ($product['category']); ?></p>
    <img src="<?php echo ($product['url']); ?>" alt="Product Image" style="max-width: 300px; height: auto;">
</body>
</html>

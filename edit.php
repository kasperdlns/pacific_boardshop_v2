<?php 
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/User.php");

session_start();

// Controleer of de gebruiker is ingelogd 
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$user = new User();
$user->setUsername($_SESSION["username"]);

if ($user->isAdmin()) {
    echo "Welkom, admin!";
} else {
    header("Location: index.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk</title>
</head>
<body>
   <!-- toon alle info van product -->
   <?php
    include_once("header.php");
    ?>
</body>
</html>

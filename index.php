<?php
    session_start();
    // if (!isset($_SESSION["username"])) {
    //     // De gebruiker is niet ingelogd, dus doorsturen naar de loginpagina
    //     header("location: login.php");
    //     exit;
    // }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    <h1>Welcome to the home page</h1>
    <a href="login.php">Login</a>
    <a href="logout.php">Logout</a>

    
</body>
</html>
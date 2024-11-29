<?php
session_start();
require "classes/User.php";

$error = false;

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    try {
        // Maak een nieuwe gebruiker aan en probeer in te loggen
        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        $user->login();

        // Sessievariabele instellen bij succesvolle login
        $_SESSION["username"] = $_POST['username'];

        // Doorsturen naar de homepagina
        header("location: index.php");
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form action="" method="post">
        <?php if ($error): ?>
            <div><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <input type="submit" value="Log in">
        </div>
    </form>
    <a href="signup.php">I don't have an account yet</a>
</body>
</html>

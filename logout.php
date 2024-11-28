<?php

session_destroy(); // Vernietig de sessie
// Redirect naar login pagina
header("Location: login.php");
exit; // Zorg ervoor dat de scriptuitvoering stopt na de redirect
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logout</title>
</head>
<body>
    
</body>
</html>
<?php 
    require "classes/User.php";

    //login
    



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
<form action="" method="post">
        <div>
            <label for="username">username</label>
            <input type="username" placeholder="username" name="username" id="username">
        </div>

        <div>
            <label for="password">password</label>
            <input type="password" placeholder="password" name="password" id="password">
        </div>

        <div>
            <input type="submit" value="Log in">
        </div>
    </form>
    
    <a href="signup.php">Ik heb nog geen account</a>
</body>
</html>
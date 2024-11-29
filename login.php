<?php 
    require "classes/User.php";

    
    $error = false;
    $success = false;

    if (!empty($_POST)) {
        try {
            $user = new User();
            $user->setUsername($_POST['username']);
            $user->setPassword($_POST['password']);
            $user->login();

            $success = "User logged in";

            if ($success) {
                session_start();
                header("location: index.php");
            }

        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }
    }
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
    
    <?php if($error): ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>

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
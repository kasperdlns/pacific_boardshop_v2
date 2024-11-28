<?php
include_once(__dir__.'/classes/User.php');

if (!empty($_POST)) {
    try {
        $user = new User();
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);

        echo $user->getPassword();

        $user->save();
        $success = "User saved";
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
    <title>log in</title>
</head>
<body>

    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div>
            <label for="firstname">firstname</label>
            <input type="text" placeholder="firstname" name="firstname" id="firstname">
        </div>

        <div>
            <label for="lastname">lastname</label>
            <input type="text" placeholder="lastname" name="lastname" id="lastname">
        </div>

        <div>
            <label for="email">email</label>
            <input type="email" placeholder="email" name="email" id="email">
        </div>

        <div>
            <label for="username">username</label>
            <input type="username" placeholder="username" name="username" id="username">
        </div>

        <div>
            <label for="password">password</label>
            <input type="password" placeholder="password" name="password" id="password">
        </div>

        <div>
            <input type="submit" value="Sign me Up">
        </div>
    </form>
    
    <a href="login.php">Ik heb al een account</a>
    
</body>
</html>
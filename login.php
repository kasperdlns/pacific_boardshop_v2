<?php
include_once(__dir__.'/classes/User.php');

// try {
//     $user = new User();
//     $user->setFirstname("Kasper");
//     $user->setLastname("De Vos");
//     $user->setEmail("kasper@test.com");
// } catch (\Throwable $th) {
//     $error = $th->getMessage();
// }

if (!empty($_POST)) {
    try {
        $user = new User();
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);
        $user->setUsername($_POST['username']);

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
            <input type="text" name="firstname" id="firstname">
        </div>

        <div>
            <label for="lastname">lastname</label>
            <input type="text" name="lastname" id="lastname">
        </div>

        <div>
            <label for="email">email</label>
            <input type="email" name="email" id="email">
        </div>

        <div>
            <label for="username">username</label>
            <input type="username" name="username" id="username">
        </div>

        <div>
            <input type="submit" value="Sign me Up">
        </div>
    </form>
</body>
</html>
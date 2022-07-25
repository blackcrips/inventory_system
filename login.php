<?php
include_once('./includes/autoLoadClassesMain.inc.php');
session_start();
$loginController = new LoginController();
$loginController->redirectingUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="./includes/login.inc.php" method="POST">
        <input type="text" id="username" name="username" placeholder="Username">
        <input type="password" id="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</body>

</html>
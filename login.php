<?php
include_once('./includes/autoLoadClassesMain.inc.php');
$loginController = new LoginController();
$loginController->redirectingUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./css/login.css" class="rel">
    <title>Login</title>
</head>

<body>

<div class="container">
  <input type="radio" name="tab" id="signin" checked="checked"/>
  <input type="radio" name="tab" id="register"/>
  <div class="pages">
      <div class="page">
        <form action="./includes/login.inc.php" method="POST">
      <div class="input">
        <div class="title"><i class="material-icons">account_box</i> USERNAME</div>
        <input type="text" class="text" id="username" name="username" placeholder=""/>
      </div>
      <div class="input">
        <div class="title"><i class="material-icons">lock</i> PASSWORD</div>
        <input type="password" class="text" id="password" name="password" placeholder=""/>
      </div>
      <div class="input">
        <input type="submit" value="ENTER"/>
      </div>
    </form>
    </div>
    <div class="page signup">
      <div class="input">
        <div class="title"><i class="material-icons">person</i> NAME</div>
        <input class="text" type="text" placeholder=""/>
      </div>
      <div class="input">
        <div class="title"><i class="material-icons">markunread_mailbox</i> EMAIL</div>
        <input class="text" type="password" placeholder=""/>
      </div>
      <div class="input">
        <input type="submit" value="SIGN ME UP!"/>
      </div>
    </div>
  </div>
  <div class="tabs">
    <label class="tab" for="signin">
      <div class="text">Sign In</div>
    </label>
    <label class="tab" for="register">
      <div class="text">Register</div>
    </label>
  </div>
</div>

<script src="./js/login.js"></script>
</body>

</html>
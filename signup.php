<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign Up</title>
</head>

<body>
    <div class="container-signup" id="container-signup">
        <form action="./includes/signup.inc.php" method="POST" id="form-signup">
            <input type="text" name="firstname" data-signup placeholder="Firstname">
            <input type="text" name="middlename" data-signup placeholder="Middlename">
            <input type="text" name="lastname" data-signup placeholder="Lastname">
            <input type="text" name="username" data-signup placeholder="Username">
            <input type="password" name="password" data-signup placeholder="Password">
            <input type="password" name="repeat-password" data-signup placeholder="Repeat Password">

            <button type="button" id="login">Submit</button>

        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/login.js"></script>
</body>

</html>
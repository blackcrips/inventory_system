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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/index.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
    	<div class="screen">
    		<div class="screen__content">
    			<form class="login" action="./includes/login.inc.php" method="POST">
    				<div class="login__field">
    					<i class="login__icon fas fa-user"></i>
    					<input type="text" class="login__input" id='username' name='username' placeholder="User name / Email">
    				</div>
    				<div class="login__field">
    					<i class="login__icon fas fa-lock"></i>
    					<input type="password" id='password' name='password' class="login__input" placeholder="Password">
    				</div>
    				<button class="button login__submit">
    					<span class="button__text">Log In Now</span>
    					<i class="button__icon fas fa-chevron-right"></i>
    				</button>				
    			</form>
    			<div class="social-login">
    				<h3>log in via</h3>
    				<div class="social-icons">
    					<a href="#" class="social-login__icon fab fa-instagram"></a>
    					<a href="#" class="social-login__icon fab fa-facebook"></a>
    					<a href="#" class="social-login__icon fab fa-twitter"></a>
    				</div>
    			</div>
    		</div>
    		<div class="screen__background">
    			<span class="screen__background__shape screen__background__shape4"></span>
    			<span class="screen__background__shape screen__background__shape3"></span>		
    			<span class="screen__background__shape screen__background__shape2"></span>
    			<span class="screen__background__shape screen__background__shape1"></span>
    		</div>		
    	</div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
</body>

</html>
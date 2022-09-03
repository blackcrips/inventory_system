<?php 
    if(isset($_POST['submit'])){
        $fileDestination = "./images/products/New Destination/";
        $fileDirectory = './images/products/Original Destination/forest.jpg';

            if (!file_exists($fileDestination)) {
                mkdir($fileDestination, 077, true);
            }

            $fileNewDestination = $fileDestination . 'Photo.jpeg' ;
            // $fileTmpDestination = '../images/products/noImageAvailable.jpeg';
    
            copy($fileDirectory,$fileNewDestination);
    }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="POST">
        <img src="./images/products/New Destination/forest.jpg" alt="Forest">
        <button type="submit" name="submit">Sumit</button>
    </form>
    
</body>
</html>
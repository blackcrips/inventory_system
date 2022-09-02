<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/sample.css">
  <title>Document</title>
</head>
<body>
  <?php 
  if(isset($_POST['submit'])){
    echo 'True';
    var_dump($_FILES);
  }
  ?>
  <div>
    <form action="" method="POST">
    <input type="file" name="Files">
    <button type="submit" name="submit">Submit</button>
    </form>
  </div>

</body>
</html>
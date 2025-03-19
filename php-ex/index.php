<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

  <div class="container mt-5">
  <form action="index.php" method="post">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="name" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Your Name</label>
    </div>

     <div class="form-floating">
        <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
     </div>
     <div>
         <button type="submit" name="sub" class="btn btn-primary mt-3">Submit</button>
     </div>
      </form>

  </div>
  
</body>
</html>

<?php

if(isset($_POST['sub'])){
  $_SESSION['name'] = $_POST['name'];
  $_SESSION['pass'] = $_POST['pass'];

  if(!empty($_SESSION['name']) && !empty($_SESSION['pass'])){
    header("location: main.php");
    exit();
  }
}


?>


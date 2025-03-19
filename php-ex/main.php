<?php
session_start();

if (isset($_POST['logout'])) {
  session_destroy();
  header('Location: index.php');
  exit(); 
}

include('header.php');
include('function.php');
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
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h2>Welcome <?php echo $_SESSION['name'] ?> To the mean page</h2>
      </div>
      <div class="card-body">
        <p>This is a simple website created using HTML, CSS, and PHP.</p>
      </div>
      <div class="card-footer">
        <p>Created by Ziyad</p>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
       <button type="submit" class="btn btn-secondary" name="logout" >Logout</button>
       </form>
       
      </div>
    </div>

  </div>



</body>
</html>


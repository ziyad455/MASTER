<?php require("nav.php"); ?>
<?php 
if (!isset($_SESSION['employee']) ) {
  header("Location: http://localhost/my-web/EMPLOYEES-MANAGMENT/404.php");
  exit();
}?>?>


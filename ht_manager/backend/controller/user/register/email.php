<?php 
session_start();
require '../../../../frontend/helper/other/user_classe.php';
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

require '../../../database/conectdb.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try{
     $email = $db->selectOne("SELECT email FROM users WHERE email = ?", [trim($_POST['email'])]);


      if ($email) {
          $_SESSION['error'] = 'Email already exists';
          header('Location: ../../../../frontend/user/register/email.php');
          exit();
      } else {
          $_SESSION['email'] = trim($_POST['email']);
          header('Location: ../../../../frontend/user/register/password.php');
          exit();
      }
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
      die();
    }
}
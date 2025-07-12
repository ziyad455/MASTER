<?php 
session_start();
require '../../../../frontend/helper/other/user_classe.php';

require '../../../database/conectdb.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $password = trim($_POST['password'] ?? '');
  $user  = new User($_SESSION['name'], $_SESSION['last_name'], $_SESSION['email']);
  $full_name = $user->getFirstName() . ' ' . $user->getLastName();
  unset($_SESSION['name']);
  unset($_SESSION['last_name']);
  unset($_SESSION['email']);
  $_SESSION['user'] = $user->toArray();

  
    try{
      $db->insert('INSERT INTO users(nom,email,mot_de_passe) value(?,?,?)', [
        $full_name,
        $_SESSION['user']['email'],
        password_hash($password, PASSWORD_DEFAULT)
    ]);
    $_SESSION['user']['id'] = $db->lastInsertId();
    header('Location: ../../../../frontend/user/Dashboard.php');
    exit();
    
    


  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    die();

  }

}
    





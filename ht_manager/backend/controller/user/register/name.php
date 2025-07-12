<?php 
session_start();


require '../../../database/conectdb.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $_SESSION['name'] = $firstName;
    $_SESSION['last_name'] = $lastName;
    header('Location: ../../../../frontend/user/register/email.php');


} 
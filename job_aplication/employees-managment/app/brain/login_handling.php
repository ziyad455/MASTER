<?php

    
session_start();

require (str_replace('\\', '/', 'C:\xampp\htdocs\my-web\employees-managment\app\database\conectdb.php')); 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($email) || empty($password)){
        header("Location: http://localhost/my-web/employees-managment/public/views/login.php?error=Please fill in all fields.");
        exit();
    }

    $query = "SELECT * FROM users WHERE email = ?";
    $user = $db->selectOne($query, [$email]);


    if($user && password_verify($password, $user['password'])){
      $_SESSION['user'] = $user;
      if($user['role'] == 'admin') {
        header("Location: http://localhost/my-web/employees-managment/public/views/admin/home.php");
        exit();
      }
      else {
        $query = "SELECT * FROM employees WHERE user_id = ?";
        $employee = $db->selectOne($query, [$user['id']]);
        if($employee) {
          $_SESSION['employee'] = $employee;
          header("Location: http://localhost/my-web/employees-managment/public/views/employee/home.php");
          exit();
        } else {
          header("Location: http://localhost/my-web/employees-managment/public/views/employee/waiting_room.php");
          exit();
        }

      }

      
        
    } else {
        header("Location: http://localhost/my-web/employees-managment/public/views/login.php?error=Invalid email or password.");
        exit();
    }
}

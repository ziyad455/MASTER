<?php
session_start();

if(isset($_SESSION['user'])) {
  if($_SESSION['user']['role'] === 'admin') {
    header('Location: http://localhost/my-web/employees-managment/public/views/admin/home.php');
    exit();
  }
}

if(isset($_SESSION['employee'])) {
  header('Location: http://localhost/my-web/employees-managment/public/views/employee/home.php');
  exit();
}

if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'employee') {
  header('Location: http://localhost/my-web/employees-managment/public/views/employee/waiting_room.php');
  exit();
}


header('Location: http://localhost/my-web/employees-managment/public/views/guiest.php');
exit();

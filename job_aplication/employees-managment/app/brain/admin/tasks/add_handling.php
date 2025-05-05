<?php
ob_start();
require (str_replace('\\', '/', 'C:\xampp\htdocs\my-web\employees-managment\app\database\conectdb.php'));
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $title = trim($_POST['title'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $due_date = trim($_POST['due_date'] ?? '');
  $assigned_to = trim($_POST['assigned_to'] ?? '');



  $errors = [];
  try{
    $db->insert("INSERT INTO tasks (title, description,assigned_to, due_date) VALUES (?, ?, ?, ?)", [$title, $description, $assigned_to, $due_date]);
    $db->insert("INSERT INTO notify (user_id,descrotption,category) VALUES (?, ?, ?)", [$assigned_to,'new task assigend: ,'.$title,'assigment' ]);
    header("Location: http://localhost/my-web/employees-managment/public/views/admin/add.php?success=success");
    exit;
  }
  catch (Exception $e) {




    header("Location: http://localhost/my-web/employees-managment/public/views/admin/tasks/add.php?error=faild");
    exit;

  }


}
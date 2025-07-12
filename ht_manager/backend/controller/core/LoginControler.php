<?php

session_start();
// var_dump($_POST);
// die();

require "../../database/conectdb.php";


    if($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['submit'])){
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

        $sql = "SELECT * FROM users WHERE email = ?";
        $para = [$email];
        $user = $db->selectOne($sql, $para);
        $first_name = explode(" ", $user['nom'])[0];
        $last_name = explode(" ", $user['nom'])[1] ?? '';


        if ($user && password_verify($pass, $user['mot_de_passe'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'first_name' =>  $first_name,
                'last_name' => $last_name,
                'email' => $user['email']
            ];

            if ($user['role']==='admin'){
              $_SESSION['admin'] = true;
              header("Location: ../../../frontend/admin/main.php");
              exit();
            }else{
              // require "../../frontend/user/Dashboard.php";
              header("Location: ../../../frontend/user/Dashboard.php");
              exit();      
            }

            



        } else {
          $error = "wrong email or password";
          // require "../../frontend/core/login.php";
          header("Location: ../../../frontend/core/login.php?msg=$error");
          exit();
        }


        
    }


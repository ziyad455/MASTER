<?php

session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header("Location: ../ht_manager/frontend/admin/main.php");
    exit();


} 

  elseif (isset($_SESSION['user'])) {
    header("Location: ../ht_manager/frontend/user/Dashboard.php");
    exit();
} 

  else {
    header("Location: ../ht_manager/frontend/core/guist.php");
    exit();
}
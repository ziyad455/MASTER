<?php
session_start();


$_SESSION = [];


session_destroy();

header('Location: ../../../frontend/core/guist.php');
exit();
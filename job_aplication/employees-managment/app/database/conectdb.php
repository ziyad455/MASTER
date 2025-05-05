<?php

$config = require('C:/xampp/htdocs/my-web/employees-managment/app/database/config.php');
spl_autoload_register(function ($classname) {
  require('C:/xampp/htdocs/my-web/employees-managment/app/database/'.$classname . '.php');
});
$db = new Database($config['DB'], 'root', 'your password');


?>

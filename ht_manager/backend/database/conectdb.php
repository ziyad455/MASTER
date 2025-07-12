<?php
$config = require('config.php');

spl_autoload_register(function ($classname) {
  require('C:/xampp/htdocs/my-web/ht_manager/backend/database/' . $classname . '.php');


});

$db = new Database($config['DB'], 'root', 'kLbpvikcnCHjfWHVJtuCqdTbIgUGnJsj');


?>

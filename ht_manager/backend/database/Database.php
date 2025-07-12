<?php

class Database{
  public $conection;

  public function __construct($config,$user_name,$password)
  {
    $d = http_build_query($config,'',';');
    $dsn = "mysql:{$d}";

    try{
      $this->conection = new PDO($dsn, $user_name,$password,[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]);
    }
    catch(PDOException $e){
      die("Connection failed: ". $e->getMessage());
    }
  }

  public function selectALL($query, $params = []){
    $stmt = $this->conection->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  public function selectOne($query, $params = []){
    $stmt = $this->conection->prepare($query);
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($query, $params = []) {
    $stmt = $this->conection->prepare($query);
    return $stmt->execute($params);
  }

  public function update($query, $params = []) {
    $stmt = $this->conection->prepare($query);
    return $stmt->execute($params);
  }

  public function delete($query, $params = []) {
    $stmt = $this->conection->prepare($query);
    return $stmt->execute($params);
  }
  public function lastInsertId() {
    return $this->conection->lastInsertId();
  }

  public function getConnectionStatus() {
    echo  $this->conection ? "Connected successfully" : "Not connected";
    die();
}
}

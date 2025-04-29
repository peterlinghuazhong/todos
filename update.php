<?php
  $host = "127.0.0.1";
  $database_name = "TODO";
  $database_user = "root";
  $database_password = "";
  $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
  );
  $sql = "SELECT * FROM todos";
  $query = $database->prepare( $sql );
  $query->execute();
  $todos = $query->fetchAll();
  $id = $_POST["id"];
  $completed = $_POST["completed"];
  if  ($completed == 0 )  {
     $sql = "UPDATE todos SET completed = 1 WHERE id = :id";
} else{
    $sql = "UPDATE todos SET completed = 0 WHERE id = :id";
}
$query = $database->prepare( $sql );
$query->execute(["id" => $id]);
header("Location: index2.php");
  exit;

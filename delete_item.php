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
  $label_id = $_POST["label_id"];
    $sql = "DELETE FROM todos WHERE id =:id";
    $query = $database ->prepare ( $sql );
    $query->execute([
        "id" => $label_id
    ]);
    header("Location: index2.php");
    exit;
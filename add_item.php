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
$task_name = $_POST["task_name"];
if ( empty ($task_name) ) {
    echo "Please fill a new task";
} else{
    $sql = "INSERT INTO todos (`label`) Value (:label)";
    $query = $database->prepare ($sql);
    $query->execute([
        "label" => $task_name
    ]);
}
header("Location: index2.php");
exit;
?>

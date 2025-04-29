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
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #F1F1F1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">
        <?php foreach ($todos as $index => $todo) { ?>
          <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
            <form method="POST" action="update.php">
              <input type="hidden" name="id" value="<?php echo $todo["id"]; ?>" />
              <input type="hidden" name="completed" value="<?php echo $todo["completed"]; ?>" />
                 <?php if ($todo["completed"] === 1){?>
                   <button class="btn btn-sm btn-success">
                   <i class ='bi bi-check-square'></i>
                   </button>
                   <span class="ms-2 text-decoration-line-through"><?php echo $todo["label"]; ?></span>
                   </form>
                 <?php }else{?>
                  <button class="btn btn-sm btn-light">
                  <i class ='bi bi-square'></i>
                   </button>
                   <span class="ms-2"><?= $todo["label"]; ?></span>
                   </form>
                 <?php } ?>
            </div>
            <form
             method="POST"
             action="delete_item.php"
             >
             <input type='hidden' name="label_id" value="<?php echo $todo["id"]; ?>" />
            <div>
              <button class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i>
              </button>
              </form>
            </div>
          </li>
          <?php } ?>
        </ul>
        <div class="mt-4">
          <form class="d-flex justify-content-between align-items-center" method="POST" action="add_item.php">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="task_name"
              required
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>







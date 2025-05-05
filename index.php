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
         <!-- If user is logged in -->
         <?php if ( isset( $_SESSION["user"] ) ) : ?>
          <p>Hello, <?= $_SESSION["user"]["name"]; ?></p>
          <div>
            <a href="logout.php">Logout</a>
          </div>
        <?php else: ?>
          <!-- If user is not logged in -->
          <div>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
          </div>
          <?php endif; ?>
           <?php if ( isset( $_SESSION["user"] ) ) : ?>
          <form method="POST" action="add_item.php">
            <div class="mt-4 d-flex justify-content-between align-items-center">
              <input
                type="text"
                class="form-control"
                placeholder="Add new student..."
                name="task_name"
                required
              />
              <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
            </div>
          </form>
        <?php endif; ?>
      </div>
    </div>

            <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px">
      <div class="card-body">
        <h3 class="card-title mb-3">todos</h3>
        <?php foreach ($todos as $index => $todo) { ?>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <h5 class="mb-0"><?php echo $index+1; ?>. <?php echo $todo["label"]; ?></h5>
            <?php if ( isset( $_SESSION["user"] ) ) : ?>
              <div class="d-flex gap-2">
                <button class="btn btn-success btn-sm" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $todo["id"]; ?>">
                  Show
                </button>
                <!-- Update button -->
                <div class="collapse" id="collapse-<?php echo $todo["id"]; ?>">
                  <form 
                    method="POST"
                    action="update.php"
                    >
                    <input type="text" name="todo_label" value="<?php echo $todo["label"]; ?>" />
                    <input type="hidden" name="todo_id" value="<?php echo $todo["id"]; ?>" />
                    <button class="btn btn-primary btn-sm"><i class="bi bi-floppy"></i></button>
                  </form>
                </div>
                <!-- Delete button -->
                <form 
                  method="POST" 
                  action="delete_item.php"
                  >
                  <!-- hidden input is to pass required data to the backend -->
                  <input type="hidden" name="todo_id" value="<?php echo $todo["id"]; ?>" />
                  <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </form>
              </div>
            <?php endif; ?>
          </div>
        <?php } ?>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
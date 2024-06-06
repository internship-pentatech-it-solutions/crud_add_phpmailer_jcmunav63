<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to your WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <?php if(!empty($user)): 
      header('Location: /crud_add_phpmailer/dashboard.php'); ?>
    <?php else: ?>
      <div class="container">
        <div class="title">
          Welcome to PentaTech IT-Solutions
        </div>
        <div class="content">
          <div style="text-align: center;">
            <ul style="list-style: none;">
              <br />
              <li><a href="/crud_add_phpmailer/login.php" style="font-size: 1.6rem;">Login page</a></li>
              <br />
              <li><a href="/crud_add_phpmailer/signup.php" style="font-size: 1.6rem;">SignUp page</a></li>
              <br />
            </ul>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </body>
</html>

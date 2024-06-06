<?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    header('Location: /crud_add_phpmailer/dashboard.php');
  }
  require 'database.php';
  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, fullname, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';

    if (!empty($results)) {
      if (password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        $_SESSION['email'] = $results['email'];
        $_SESSION['fullname'] = $results['fullname'];
        // $user = $results;
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Login successful!",
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = "/crud_add_phpmailer/dashboard.php";
                });
            </script>';
        header("Location: /crud_add_phpmailer/dashboard.php");
      } else {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Sorry, the email or password don\'t match",
                });
            </script>';
        $message = 'Sorry, the email or password don\'t match';
        // $user = [];
      }
    } else {
      echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Sorry, the email does not exist",
                });
            </script>';
      $message = 'Sorry, the email does not exist';
      // $user = [];
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Form | PentaTech-IT-Solutions</title>
    <link rel="stylesheet" href="assets/css/style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
      .input-box {
        width: 100% !important;
      }
      .container {
        max-width: 500px;
      }
      .user-details {
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="title">
        Login
      </div>
      <div class="content">
        <?php if(!empty($message)): ?>
          <p> <?= $message ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
          <div class="user-details">
            <div class="input-box">
              <span class="details">Email</span>
              <input name="email" type="text" placeholder="Enter your email" required>
            </div>
            <div class="input-box">
              <span class="details">Password</span>
              <input name="password" type="password" placeholder="Enter your Password" minlength="6" required>
            </div>
          </div>
          <div class="button">
            <input type="submit" value="Login">
          </div>
          <p>Don't have an account? <a href="/crud_add_phpmailer/signup.php">Signup</a></p>
        </form>
      </div>
    </div>
  </body>
</html>

<?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login-simple/dashboard.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';

    if (!empty($results)) {
      if (password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        $_SESSION['fullname'] = $results['fullname'];
        header("Location: /php-login-simple/dashboard.php");
      } else {
        $message = 'Sorry, the email or password don\'t match';
      }
    } else {
      $message = 'Sorry, the email does not exist';
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Form | PentaTech-IT-Solutions</title>
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> -->
    <link rel="stylesheet" href="assets/css/style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
          <p>Don't have an account? <a href="signup.php">Signup</a></p>
        </form>
      </div>
    </div>
  </body>
</html>

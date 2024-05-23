<?php
  require 'database.php';
  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password, username, fullname, phonenumber) VALUES (:email, :password, :username, :fullname, :phonenumber)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':fullname', $_POST['fullname']);
    $stmt->bindParam(':phonenumber', $_POST['phonenumber']);

    if ($stmt->execute()) {
      echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Successfully created new user!",
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = "/crud_add_pdf_project/login.php";
                });
            </script>';
      // $message = 'Successfully created new user';
    } else {
      echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Sorry there must have been an issue creating your account",
                });
            </script>';
      // $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>SignUp Form | PentaTech-IT-Solutions</title>
    <link rel="stylesheet" href="./assets/css/style2.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <div class="container">
      <div class="title">Registration</div>
      <div><?php if(!empty($message)): ?>
            <p><?= $message ?></p>
          <?php endif; ?>
      </div>
      <div class="content">
        <form action="signup.php" method="post">
          <div class="user-details">
            <div class="input-box">
              <span class="details">Full Name</span>
              <input type="text" placeholder="Enter your name" name="fullname" required />
            </div>
            <div class="input-box">
              <span class="details">Username</span>
              <input type="text" placeholder="Enter your username" name="username" required />
            </div>
            <div class="input-box">
              <span class="details">Email</span>
              <input type="email" placeholder="Enter your email" name="email" required />
            </div>
            <div class="input-box">
              <span class="details">Phone Number</span>
              <input type="text" placeholder="Enter your phone number (12 digits)" name="phonenumber" maxlength="12" required />
            </div>
            <div class="input-box">
              <span class="details">Password</span>
              <input type="password" placeholder="Enter your password" name="password" minlength="6" required />
            </div>
            <div class="input-box">
              <span class="details">Confirm Password</span>
              <input type="password" placeholder="Confirm your password" name="confirmpassword" minlength="6" required />
            </div>
          </div>
          <div class="button">
            <input type="submit" name="signup-button" value="Register" />
          </div>
          <p>Already have an account? <a href="./login.php">Log in</a></p>
        </form>
      </div>
    </div>
  </body>
</html>

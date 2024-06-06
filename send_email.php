<?php
  session_start();
  // if (!isset($_SESSION['user_id'])) {
  //   header('Location: /crud_add_pdf_project/index.php');
  // }
  // IF THE USER IS NOT LOGGED IN HE/SHE IS REDIRECTED TO INDEX.PHP
  if (!isset($_SESSION['user_id'])) {
    echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "You session has expired or you are not logged in.",
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = "/crud_add_phpmailer/login.php";
                });
            </script>';
    header("Location: /crud_add_phpmailer/index.php");
    // exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Send Email | PentaTech-IT-Solutions</title>
      <link rel="stylesheet" href="assets/css/style2.css" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
      <div class="dashboard-container">
          <header>
              <div class="title">PentaTech IT-Solutions - Send Email</div>
          </header>
          <form action="send_email.php?id=<?= $id ?>" method="POST" style="margin-top: 20px;">
              <div class="user-details">
                  <div class="input-box">
                      <span class="details">Name</span>
                      <input type="text" name="name" value="<?= $member['firstname'] . ' ' . $member['lastname'] ?>" required readonly>
                  </div>
                  <div class="input-box">
                      <span class="details">Email</span>
                      <input type="email" name="email" value="<?= $member['email'] ?>" required readonly>
                  </div>
                  <div class="input-box">
                      <span class="details">Department</span>
                      <input type="text" name="department" value="<?= $member['department'] ?>" required readonly>
                  </div>
                  <div class="input-box">
                      <span class="details">Date</span>
                      <input type="date" name="date" value="<?= $today ?> required>
                  </div>
                  <div class="input-box">
                      <span class="details">Subject</span>
                      <input type="text" name="subject" required>
                  </div>
                  <div class="input-box">
                      <span class="details">Message</span>
                      <textarea name="message" rows="5" required></textarea>
                  </div>
                  <div class="button">
                      <input type="submit" value="Send Email">
                  </div>
              </div>
          </form>
          <a href="/crud_add_phpmailer/dashboard.php">Back to Dashboard</a>
      </div>
  </body>
</html>

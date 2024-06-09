<?php
  //IMPORT PHPMAILER CLASSES INTO THE GLOBAL NAMESPACE
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  //LOAD COMPOSER'S AUTOLOADER
  require 'vendor/autoload.php';

  // REQUIRE THE DATABASE CONNECTION
  require_once 'database.php';

  // VERIFY IF THE SESSION HAS EXPIRED
  session_start();
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
  }

  if (!isset($_GET['id'])) {
    header("Location: /crud_add_phpmailer/dashboard.php");
    exit();
  }

  $id = $_GET['id'];

  // GET TODAY'S DATE IN YYYY-MM-DD FORMAT
  $today = date('Y-m-d');

  // FETCH MEMBER DETAILS
  $sql = "SELECT members.*, teams.name as team_name FROM members LEFT JOIN teams ON members.teams_id = teams.id WHERE members.id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
  $member = $stmt->fetch(PDO::FETCH_ASSOC);

  // REDIRECT USER IF MEMBER NOT FOUND
  if (empty($member)) {
      echo "Member not found.";
      exit();
  }

  // GET VALUES FROM EMAIL FORM TO CREATE THE MESSAGE
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // PHPMAILER SETUP
    $mail = new PHPMailer();

    try {
      $mail->isSMTP();
      $mail->Host = 'sandbox.smtp.mailtrap.io';
      $mail->SMTPAuth = true;
      $mail->Username = 'username';
      $mail->Password = 'secret';
      $mail->Port = 2525;

      // DEBUGGING (ONLY WHEN TESTING)
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      // $mail->Debugoutput = 'html';

      // SUBJECT, SENT FROM, AND BODY CONTENT
      $mail->setFrom($email, $name);
      $mail->addAddress('juancarlos.munoz@loyola.edu.mx');
      
      $img_contents = base64_encode(file_get_contents(__DIR__ . "/assets/images/logoPT-ITS.PNG"));
      $logo_url = "'data:image/png;base64,$img_contents' width='100px'";

      $body = "<table><tr><td><img src=$logo_url; /></td><td><h1>PentaTech IT-Solutions - EMail Sending with PHPMailer</h1></td></tr></table>
        <table><tr><td><p><strong>Name:</strong> $name</p></td><td><p><strong>Department:</strong> $department</p></td></tr>
        <tr><td colspan='2'><p><strong>Date:</strong> $date</p></td></tr><tr><td colspan='2'><p><strong>Message:</strong> $message</p></td></tr></table>";

      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $body;
      $mail->AltBody = strip_tags($body);
      $mail->addAttachment('./members_list.pdf', 'members_list.pdf');
      $mail->send();

      echo "Email sent successfully!";
    } catch (Exception $e) {
      echo "Message couldn't be sent. Mailer Error: " . $mail->ErrorInfo;
    }

    //CLEAR ADRESSES TO SEND NEXT MESSAGE
    $body = "";
    $mail->clearAddresses();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Send Email | PentaTech-IT-Solutions</title>
    <link rel="stylesheet" href="assets/css/style4.css" />
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
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="title" style="font-size: 1.3rem; padding-bottom: 8px;">
        PentaTech IT-Solutions - Send Email
      </div>
      <div class="content">
        <form action="send_email.php?id=<?= $id ?>" method="POST" style="margin-top: 5px;">
          <div class="user-details">
            <div class="input-box" style="margin-bottom: 6px">
              <span class="details">Name</span>
              <input type="text" name="name" value="<?= $member['firstname'] . ' ' . $member['lastname'] ?>" style="width: 450px" required readonly>
            </div>
            <div class="input-box" style="margin-bottom: 6px">
              <span class="details">Email</span>
              <input type="email" name="email" value="<?= $member['email'] ?>" style="width: 450px" required readonly>
            </div>
            <div class="input-box" style="margin-bottom: 6px">
              <span class="details">Department</span>
              <input type="text" name="department" value="<?= $member['department'] ?>" style="width: 450px" required readonly>
            </div>
            <div class="input-box" style="margin-bottom: 6px">
              <span class="details">Date</span>
              <input type="date" name="date" value="<?= $today ?>" style="width: 450px" required>
            </div>
            <div class="input-box" style="margin-bottom: 6px">
              <span class="details">Subject</span>
              <input type="text" name="subject" style="width: 450px" required>
            </div>
            <div class="input-box" style="margin-bottom: 6px">
              <span class="details" style="vertical-align: top;">Message</span>
              <textarea name="message" rows="3" style="width: 364px" required></textarea>
            </div>
            <div class="button">
              <input type="submit" value="Send Email" style="width: 100%; height: 34px;" class="dash-button">
            </div>
          </div>
        </form>
        <a href="/crud_add_phpmailer/dashboard.php">Back to Dashboard</a>
      </div>
    </div>
  </body>
</html>

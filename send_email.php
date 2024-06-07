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
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host = 'localhost'; // MERCURY MAIL SERVER
      // $mail->Host = 'smtp-mail.outlook.com'; // smtp.gmail.com  smtp-mail.outlook.com  smtp.office365.com
      $mail->SMTPAuth = true;
      $mail->Username = 'test@localhost'; // MERCURY MAIL TEST USERNAME
      $mail->Password = 'pass123';
      // $mail->AuthType = 'LOGIN';
      // $mail->SMTPSecure = 'tls';
      // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 25; // 587 for TLS, 465 for SSL

      // DEBUGGING (ONLY WHEN TESTING)
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->Debugoutput = 'html';

      // DISABLE SSL CERTIFICATE VERIFICATION (ONLY HOTMAIL OR GMAIL)
      // $mail->SMTPOptions = array(
      //   'ssl' => array(
      //       'verify_peer' => false,
      //       'verify_peer_name' => false,
      //       'allow_self_signed' => true
      //   )
      // );

      // SUBJECT, SENT FROM, AND BODY CONTENT
      $mail->setFrom($email, $name);
      $mail->addAddress('jcmunav63@gmail.com');

      $body = "<p><strong>Name:</strong> $name</p><p><strong>Department:</strong> $department</p><p><strong>Date:</strong> $date</p><p><strong>Message:</strong> $message</p>";

      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $body;
      $mail->AltBody = strip_tags($body);
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
        /* justify-content: center;
        align-items: center; */
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
          </div>
          <div class="button">
            <input type="submit" value="Send Email" style="width: 100%; height: 34px;" class="dash-button">
          </div>
        </form>
        <a href="/crud_add_phpmailer/dashboard.php">Back to Dashboard</a>
      </div>
    </div>
  </body>
</html>

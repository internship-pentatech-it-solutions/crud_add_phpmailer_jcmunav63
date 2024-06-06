<?php
  session_start();
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
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Home Page / Dashboard | PentaTech-IT-Solutions</title>
    <link rel="stylesheet" href="assets/css/style2.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
      .input-box {
        width: 100% !important;
      }
      .user-details {
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
    </style>
  </head>
  <body>
    <?php if(!isset($_SESSION['user_id'])):
      header('Location: /crud_add_phpmailer/index.php'); ?>
    <?php else: ?>
      <div class="dashboard-container">
        <header>
          <div class="title">Welcome to PentaTech IT-Solutions - Teams Table</div>
          <div class="header-div">
            <button onclick="window.location.href='/crud_add_phpmailer/team_form.php'" class="dash-btn">Add Team</button>
            <button onclick="window.location.href='/crud_add_phpmailerdashboard.php'" class="dash-btn">Dashboard</button>
            <p><a href="./logout.php" style="font-size: 1.3rem;">Logout</a></p>
          </div>
        </header>
        <div class="table-container" style="text-align: center;">
          <table id="teamssTable" class="display">
            <thead>
              <tr>
                <th>Team Name</th>
                <th>Description</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                include 'database.php';
                $stmt = $conn->query("SELECT * FROM teams");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['description']}</td>
                            <td>
                                <a href='team_form.php?id={$row['id']}'>Edit</a>
                                <a href='delete_team.php?id={$row['id']}'>Delete</a>
                            </td>
                          </tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php endif; ?>
  </body>
</html>

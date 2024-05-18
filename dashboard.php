<?php
  session_start();
  // IF THE USER IS NOT LOGGED IN HE IS REDIRECTED TO INDEX.HTML
  if (!isset($_SESSION['user_id'])) {
    header("Location: /php-login-simple/index.php");
    exit();
  }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Home Page / Dashboard | PentaTech-IT-Solutions</title>
    <link rel="stylesheet" href="assets/css/style2.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <div>
      <div class="title">Welcome to PentaTech IT-Solutions - Team Members Dashboard</div>
      <div class="content">
        <div style="display: flex; justify-content: space-around;">
          <button onclick="window.location.href='team_form.php'">Add Team</button>
          <button onclick="window.location.href='member_form.php'">Add Member</button>
          <p><a href="logout.php" style="font-size: 1.6rem;">Logout</a></p>
        </div>
        <div style="text-align: center;">
          <table id="membersTable" class="display">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>About</th>
                    <th>Image</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                <?php include 'members_list.php'; ?>
            </tbody>
          </table>
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
      <script>
          $(document).ready(function() {
              $('#membersTable').DataTable();
          });
      </script>
    </div>
  </body>
</html>

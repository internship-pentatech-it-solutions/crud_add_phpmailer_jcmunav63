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
                    window.location.href = "/crud_add_pdf_project/login.php";
                });
            </script>';
    header("Location: /crud_add_pdf_project/index.php");
    // exit();
  }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Home Page / Dashboard | PentaTech-IT-Solutions</title>
    <link rel="stylesheet" href="assets/css/style3.css" />
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
      header('Location: /crud_add_pdf_project/index.php'); ?>
    <?php else: ?>
      <div class="dashboard-container">
        <header>
          <div class="title">Welcome to PentaTech IT-Solutions - Team Members Dashboard</div>
          <div class="header-div">
            <button onclick="window.location.href='/crud_add_pdf_project/teams.php'" class="dash-btn">Teams table</button>
            <button onclick="window.location.href='/crud_add_pdf_project/member_form.php'" class="dash-btn">Add Member</button>
            <p><a href="./logout.php" style="font-size: 1.3rem;">Logout</a></p>
          </div>
        </header>
          <div class="table-container" style="text-align: center;">
            <table id="membersTable" class="display">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Position</th>
                  <th>Department</th>
                  <th>About</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <!-- INSERT THE DATATABLE CONTROL TO DISPLAY THE MEMBERS LIST -->
              <tbody>
                <?php include 'members_list.php'; ?>
              </tbody>
            </table>
          </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script>
          // CONFIGURE THE DATATABLE PAGING LINKS
          $(document).ready(function() {
            $('#members-table').DataTable({
                  "dom": '<"bottom"flp><"clear">',
                  "paging": true,
                  "searching": true,
                  "ordering": true,
                  "pageLength": 5
              });
            });
        </script>
      </div>
    <?php endif; ?>
  </body>
</html>

<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'team_management';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Login successful!",
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.href = "/crud_add_phpmailer/index.php";
                });
            </script>';
  // die('Connection Failed: ' . $e->getMessage());
}

?>

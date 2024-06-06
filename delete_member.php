<?php
require_once 'database.php';

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
    if ($stmt->execute([$_GET['id']])) {
        header("Location: /crud_add_phpmailer/dashboard.php");
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

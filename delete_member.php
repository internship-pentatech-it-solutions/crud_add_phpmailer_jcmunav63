<?php
require_once 'database.php';

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
    // $stmt->bind_param("i", $_GET['id']);
    if ($stmt->execute([$_GET['id']])) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
    // $stmt->close();
}
// $conn->close();
?>

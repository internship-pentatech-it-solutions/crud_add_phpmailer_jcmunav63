<?php
require_once 'database.php';

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM teams WHERE id = ?");
    if ($stmt->execute([$_GET['id']])) {
        header("Location: /crud_add_pdf_project/teams.php");
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

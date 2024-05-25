<?php
require_once 'database.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];

if ($id) {
    // UPDATE EXISTING TEAM
    $stmt = $conn->prepare("UPDATE teams SET name = ?, description = ? WHERE id = ?");
    $stmt->execute([$name, $description, $id]);
} else {
    // ADD NEW TEAM
    $stmt = $conn->prepare("INSERT INTO teams (name, description) VALUES (?, ?)");
    $stmt->execute([$name, $description]);
}

header("Location: /crud_add_pdf_project/dashboard.php");
exit();
?>

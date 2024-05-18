<?php
require_once 'database.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];

if ($id) {
    // Update existing team
    $stmt = $conn->prepare("UPDATE teams SET name = ?, description = ? WHERE id = ?");
    $stmt->execute([$name, $description, $id]);
} else {
    // Add new team
    $stmt = $conn->prepare("INSERT INTO teams (name, description) VALUES (?, ?)");
    $stmt->execute([$name, $description]);
}

header("Location: dashboard.php");
exit();
?>

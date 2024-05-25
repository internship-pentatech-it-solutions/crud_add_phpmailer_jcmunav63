<?php
require_once 'database.php';

$id = $_POST['id'];
$teams_id = $_POST['teams_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$position = $_POST['position'];
$department = $_POST['department'];
$about = $_POST['about'];
$image_url = '';

if ($_FILES['image']['name']) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image_url = $target_file;
}

if ($id) {
    if ($image_url) {
        $stmt = $conn->prepare("UPDATE members SET teams_id = ?, firstname = ?, lastname = ?, position = ?, department = ?, about = ?, image_url = ? WHERE id = ?");
        $stmt->execute([$teams_id, $firstname, $lastname, $position, $department, $about, $image_url, $id]);
    } else {
        $stmt = $conn->prepare("UPDATE members SET teams_id = ?, firstname = ?, lastname = ?, position = ?, department = ?, about = ? WHERE id = ?");
        $stmt->execute([$teams_id, $firstname, $lastname, $position, $department, $about, $id]);
    }
} else {
    $stmt = $conn->prepare("INSERT INTO members (teams_id, firstname, lastname, position, department, about, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$teams_id, $firstname, $lastname, $position, $department, $about, $image_url]);
}

header("Location: /crud_add_pdf_project/dashboard.php");
exit();
?>

<?php
require_once 'database.php';

$team = [
    'id' => '',
    'name' => '',
    'description' => ''
];

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM teams WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    if ($stmt->rowCount() > 0) {
        $team = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $team['id'] ? 'Edit' : 'Add'; ?> Team</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><?php echo $team['id'] ? 'Edit' : 'Add'; ?> Team</h1>
    <form action="save_team.php" method="post">
        <input type="hidden" name="id" value="<?php echo $team['id']; ?>">
        <label for="name">Team Name:</label>
        <input type="text" name="name" value="<?php echo $team['name']; ?>" required><br>
        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $team['description']; ?></textarea><br>
        <button type="submit">Save</button>
    </form>
    <button onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
</body>
</html>

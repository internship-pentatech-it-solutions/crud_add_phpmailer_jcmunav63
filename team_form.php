<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: /crud_add_pdf_project/index.php');
}

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
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
  <?php if(!isset($_SESSION['user_id'])):
    header('Location: /crud_add_pdf_project/index.php'); ?>
  <?php else: ?>
    <div class="container">
      <div class="title">
        <?php echo $team['id'] ? 'Edit' : 'Add'; ?> Team
      </div>
      <div class="content">
        <form action="save_team.php" method="post">
          <div class="user-details">
            <input type="hidden" name="id" value="<?php echo $team['id']; ?>"><br />
            <div class="input-box" width="100%">
              <label for="name">Team Name:</label><br />
              <input type="text" name="name" value="<?php echo $team['name']; ?>" required><br>
            </div><br />
            <div class="input-box" width="100%">
              <label for="description">Description:</label><br />
              <textarea name="description" required><?php echo $team['description']; ?></textarea><br>
            </div>
          </div>
          <div class="button">
            <input type="submit" value="Save">
          </div>
          <p><a href="/crud_add_pdf_project/dashboard.php">Back to Dashboard</a></p>
          <!-- <button onclick="window.location.href='/crud_add_pdf_project/dashboard.php'" class="dash-btn">Back to Dashboard</button> -->
        </form>
      </div>
    </div>
  <?php endif; ?>
</body>
</html>

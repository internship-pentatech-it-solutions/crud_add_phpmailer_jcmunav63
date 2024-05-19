<?php
require_once 'database.php';

$member = [
    'id' => '',
    'teams_id' => '',
    'firstname' => '',
    'lastname' => '',
    'position' => '',
    'department' => '',
    'about' => '',
    'image_url' => ''
];

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM members WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    if ($stmt->rowCount() > 0) {
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title><?php echo $member['id'] ? 'Edit' : 'Add'; ?> Member</title>
  </head>
  <body>
    <h1><?php echo $member['id'] ? 'Edit' : 'Add'; ?> Member</h1>
    <form action="save_member.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
      <label for="teams_id">Team:</label>
      <select name="teams_id" required>
          <?php
          $teams = $conn->query("SELECT * FROM teams");
          foreach ($teams as $team) {
              $selected = $team['id'] == $member['teams_id'] ? 'selected' : '';
              echo "<option value='{$team['id']}' {$selected}>{$team['name']}</option>";
          }
          ?>
      </select><br>
      <label for="firstname">First Name:</label>
      <input type="text" name="firstname" value="<?php echo $member['firstname']; ?>" required><br>
      <label for="lastname">Last Name:</label>
      <input type="text" name="lastname" value="<?php echo $member['lastname']; ?>" required><br>
      <label for="position">Position:</label>
      <input type="text" name="position" value="<?php echo $member['position']; ?>"><br>
      <label for="department">Department:</label>
      <input type="text" name="department" value="<?php echo $member['department']; ?>"><br>
      <label for="about">About:</label>
      <textarea name="about"><?php echo $member['about']; ?></textarea><br>
      <label for="image">Profile Picture:</label>
      <input type="file" name="image"><br>
      <?php if ($member['image_url']): ?>
          <img src="<?php echo $member['image_url']; ?>" width="100" height="100"><br>
      <?php endif; ?>
      <button type="submit">Save</button>
    </form>
  </body>
</html>

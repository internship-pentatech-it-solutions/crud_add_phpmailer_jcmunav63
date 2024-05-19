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
      <link rel="stylesheet" href="assets/css/style2.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <style>
      .input-box {
        width: 100% !important;
      }
      .container {
        position: absolute;
        top: 0;
        max-width: 700px;
      }
      .user-details {
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="title"><?php echo $member['id'] ? 'Edit' : 'Add'; ?> Member</div>
      <div class="content">
        <form action="save_member.php" method="post" enctype="multipart/form-data">
          <div class="user-details">
            <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
            <div class="input-box">
              <span class="details">Team</span>
              <select name="teams_id" width="200" required>
                  <?php
                  $teams = $conn->query("SELECT * FROM teams");
                  foreach ($teams as $team) {
                      $selected = $team['id'] == $member['teams_id'] ? 'selected' : '';
                      echo "<option value='{$team['id']}' {$selected}>{$team['name']}</option>";
                  }
                  ?>
              </select><br>
            </div>
            <div class="input-box">
              <span class="details">First Name</span>
              <input type="text" name="firstname" value="<?php echo $member['firstname']; ?>" width="200" required><br>
            </div>
            <div class="input-box">
              <span class="details">Last Name</span>
              <input type="text" name="lastname" value="<?php echo $member['lastname']; ?>" width="200" required><br>
            </div>
            <div class="input-box">
              <span class="details">Position</span>
              <input type="text" name="position" value="<?php echo $member['position']; ?>" width="200"><br>
            </div>
            <div class="input-box">
              <span class="details">Department</span>
              <input type="text" name="department" value="<?php echo $member['department']; ?>" width="200"><br>
            </div>
            <div class="input-box">
              <span class="details">About</span>
              <textarea name="about" width="400"><?php echo $member['about']; ?></textarea><br>
            </div>
            <div class="input-box">
              <span class="details">Profile Picture</span>
              <input type="file" name="image" width="200"><br>
            </div>
            <?php if ($member['image_url']): ?>
                <img src="<?php echo $member['image_url']; ?>" width="100" height="100"><br>
            <?php endif; ?>
          </div>
          <div class="button">
            <button type="submit">Save</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>

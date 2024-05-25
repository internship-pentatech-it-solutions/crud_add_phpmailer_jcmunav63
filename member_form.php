<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: /crud_add_pdf_project/index.php');
}

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
    <?php if(!isset($_SESSION['user_id'])):
      header('Location: /crud_add_pdf_project/index.php'); ?>
    <?php else: ?>
      <div class="container">
        <div class="title"><?php echo $member['id'] ? 'Edit' : 'Add'; ?> Member</div>
        <div class="content">
          <form action="/crud_add_pdf_project/save_member.php" method="post" enctype="multipart/form-data">
            <div class="user-details">
              <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
              <div class="input-box">
                <span class="details">Team</span>
                <span class="input-box" style="margin-bottom: 15px; width: 100%; border: 1px solid #9b59b6; 
                  border-radius: 6px; padding: 8px 4px; width: 200;">
                  <select name="teams_id" required>
                      <?php
                      $teams = $conn->query("SELECT * FROM teams");
                      foreach ($teams as $team) {
                          $selected = $team['id'] == $member['teams_id'] ? 'selected' : '';
                          echo "<option value='{$team['id']}' {$selected}>{$team['name']}</option>";
                      }
                      ?>
                  </select><br>
                </span>
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
              <div class="input-box" widht="100%">
                <span class="details">About</span>
                <textarea name="about" class="txt-area"><?php echo $member['about']; ?></textarea><br>
              </div>
              <div class="input-box">
                <span class="details">Profile Picture</span>
                <input type="file" name="image" placeholder="Select file" width="200" class="dash-btn"><br>
              </div>
              <?php if ($member['image_url']): ?>
                  <img src="<?php echo $member['image_url']; ?>" width="100" height="100"><br>
              <?php endif; ?>
            </div>
            <div class="button">
              <input type="submit" value="Save">
            </div>
          </form>
        </div>
      </div>
    <?php endif; ?>
  </body>
</html>

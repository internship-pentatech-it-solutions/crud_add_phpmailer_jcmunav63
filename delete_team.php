<?php
require_once 'database.php';

if (isset($_GET['id'])) {
  $team_id = $_GET['id'];
  try {
      // START A TRANSACTION
      $conn->beginTransaction();

      // CHECK HOW MANY MEMBERS THE TEAM HAS
      $sql = "SELECT teams.* FROM teams WHERE teams.id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$team_id]);
      $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (!empty($members)) {
        // DELETE ALL MEMBERS ASSOCIATED WITH THIS TEAM
        $stmt = $conn->prepare("DELETE FROM members WHERE teams_id = ?");
        $stmt->execute([$team_id]);
      }

      // DELETE THE TEAM
      $stmt = $conn->prepare("DELETE FROM teams WHERE id = ?");
      $stmt->execute([$team_id]);

      // COMMIT THE TRANSACTION
      $conn->commit();

      header("Location: /crud_add_pdf_project/teams.php");
  } catch (Exception $e) {
      // ROLLBACK THE TRANSACTION IF SOMETHING HAS FAILED
      $conn->rollBack();
      echo "Error: " . $e->getMessage();
  }
}
?>

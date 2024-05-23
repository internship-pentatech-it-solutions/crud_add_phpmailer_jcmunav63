<?php
require_once 'database.php';

$sql = "SELECT members.*, teams.name as team_name FROM members LEFT JOIN teams ON members.teams_id = teams.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($members)) {
  foreach ($members as $row) {
    echo "<tr>
            <td>{$row['firstname']}</td>
            <td>{$row['lastname']}</td>
            <td>{$row['position']}</td>
            <td>{$row['department']}</td>
            <td>{$row['about']}</td>
            <td><img src='{$row['image_url']}' width='50' height='50'></td>
            <td>
                <a href='/crud_add_pdf_project_jcmunav63/member_form.php?id={$row['id']}'>Edit</a>
                <a href='/crud_add_pdf_project_jcmunav63/delete_member.php?id={$row['id']}'>Delete</a>
            </td>
          </tr>";
  }
} else {
  echo '<script>
                Swal.fire({
                    icon: "question",
                    title: "No members found!",
                    text: "Please add some members.",
                });
            </script>';
  echo "<tr><td colspan='7'>No members found</td></tr>";
}
?>

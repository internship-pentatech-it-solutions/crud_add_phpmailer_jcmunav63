<?php
require_once 'database.php';
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

// FETCH MEMBERS DATA
$sql = "SELECT members.*, teams.name as team_name FROM members LEFT JOIN teams ON members.teams_id = teams.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

// FUNCTION TO CONVERT AN IMAGE TO BASE64
function convertImageToBase64($imagePath) {
  $imageData = file_get_contents($imagePath);
  return base64_encode($imageData);
}

$logoPath = __DIR__ . '/assets/images/logoPT-ITS.PNG';
$logoBase64 = convertImageToBase64($logoPath);

// START OUTPUT BUFFERING TO CAPTURE THE HTML
ob_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <title>PDF Report | PentaTech-IT-Solutions</title>
  <style>
    .input-box {
      width: 100% !important;
    }
    .user-details {
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid black;
    }
    th, td {
      padding: 8px;
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <header style="display: flex;">
      <table style="margin-bottom: 10px">
        <tr>
          <td>
            <img src="data:image/png;base64,<?= $logoBase64 ?>" width="100px" height="auto" style="margin-left: 25px">
          </td>
          <td>
            <h3 style="text-align: center; vertical-align: middle;">PentaTech IT-Solutions - Team Members PDF Report</h3>
          </td>
        </tr>
      </table>
    </header>
    <div class="table-container" style="text-align: center;">
      <table id="membersTable" class="display">
        <thead>
          <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Team name</th>
            <th>Full Name</th>
            <th>Position</th>
            <th>Department</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($members)) {
            foreach ($members as $row) {
              $imagePath = __DIR__ . '/' . $row['image_url'];
                            if (file_exists($imagePath)) {
                                $imageUrl = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($imagePath));
                            } else {
                                $imageUrl = $row['image_url'];
                            }
              echo "<tr>
                <td>{$row['id']}</td>
                <td><img src='{$imageUrl}' width='50px' height='auto'></td>
                <td>{$row['team_name']}</td>
                <td>{$row['firstname']} {$row['lastname']}</td>
                <td>{$row['position']}</td>
                <td>{$row['department']}</td>
              </tr>";
            }
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>

<?php
// GET THE HTML CONTENT
$html = ob_get_clean();

// INITIALIZE THE DOMPDF LIBRARY
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// SET THE PAPER SIZE AND ITS ORIENTATION
$dompdf->setPaper('letter', 'landscape');

// RENDER THE PDF
$dompdf->render();

// OUTPUT THE PDF TO THE BROWSER
$dompdf->stream("members_list.pdf", array("Attachment" => false));
exit;
?>

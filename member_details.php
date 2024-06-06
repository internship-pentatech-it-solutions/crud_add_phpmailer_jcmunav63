<?php
require_once 'database.php';
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

if (!isset($_GET['id'])) {
  header("Location: /crud_add_phpmailer/dashboard.php");
  exit();
}

$id = $_GET['id'];

// FETCH MEMBER DETAILS
$sql = "SELECT members.*, teams.name as team_name FROM members LEFT JOIN teams ON members.teams_id = teams.id WHERE members.id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);

// REDIRECT USER IF MEMBER NOT FOUND
if (empty($member)) {
  echo "Member not found.";
  exit();
}

function getImageBase64($path) {
  $imagePath = __DIR__ . '/' . $path;
  if (file_exists($imagePath)) {
      $imageData = file_get_contents($imagePath);
      $base64 = base64_encode($imageData);
      return 'data:image/jpeg;base64,' . $base64;
  }
  return $path;
}

if (isset($_GET['generate_pdf'])) {
  // GENERATE PDF
  ob_start();
  ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>PDF Report | PentaTech-IT-Solutions</title>
      <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; margin-bottom: 20px;}
        .content { margin: 0 auto; width: 90%; }
        .content h2 { text-align: center; }
        .content p { margin: 10px 0; }
      </style>
    </head>
    <body>
      <div class="header">
        <table style="margin-bottom: 10px; width: 90%; text-align: center;">
          <tr>
            <td><img src="data:image/png;base64,<?= base64_encode(file_get_contents(__DIR__ . '/assets/images/logoPT-ITS.PNG')) ?>" width="100px" /></td>
            <td><h1>PentaTech IT-Solutions - Member Details PDF Report</h1></td>
          </tr>
        </table>
      </div>
      <div class="table-container">
        <table style="border: none;">
          <tr>
            <td style="border: none;">
              <img src="<?= getImageBase64($member['image_url']) ?>" width='70px' height='auto'>
            </td>
            <td style="border: none;">
              <h2 style="font-size: 1.6rem; vertical-align: center; margin-left: 20px;"><?= "{$member['firstname']} {$member['lastname']}" ?></h2>
            </td>
          </tr>
        </table>
        <div style="margin-left: 1%; margin-right: 1%; width: auto;">
          <p><strong>Team:</strong> <?= $member['team_name'] ?></p>
          <p><strong>Position:</strong> <?= $member['position'] ?></p>
          <p><strong>Department:</strong> <?= $member['department'] ?></p>
          <p><strong>About:</strong> <?= $member['about'] ?></p>
        </div>
      </div>
    </body>
  </html>
  <?php
    $html = ob_get_clean();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter', 'portrait');
    $dompdf->render();
    $dompdf->stream("member_details.pdf", ["Attachment" => false]);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDF Report | PentaTech-IT-Solutions</title>
  <link rel="stylesheet" href="assets/css/style2.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
  <div class="dashboard-container" style="position: absolute; margin-top: 10px;">
    <header style="margin-top: 15px; display: flex; align-items: center; justify-content: space-between;">
      <div class="title" style="font-size: 1.3rem; font-weight: 600;">PentaTech IT-Solutions - Member Details PDF Report</div><br />
      <div style="display: flex;">
        <a href="/crud_add_phpmailer/dashboard.php" style="font-size: 1.3rem;">Dashboard</a>
        <a href="./logout.php" style="font-size: 1.3rem; margin-left: 20px;">Logout</a>
      </div>
    </header>
    <div class="table-container" style="margin-top: 20px;">
      <table style="border: none;">
        <tr>
          <td style="border: none;">
            <img src="<?= getImageBase64($member['image_url']) ?>" width="70" height="auto">
          </td>
          <td style="border: none;">
            <h2 style="font-size: 1.6rem; vertical-align: center;"><?= "{$member['firstname']} {$member['lastname']}" ?></h2>
          </td>
        </tr>
      </table>
      <div style="margin-left: 5%; margin-right: 5%; width: auto;">
        <p><strong>Team:</strong> <?= $member['team_name'] ?></p><br />
        <p><strong>Position:</strong> <?= $member['position'] ?></p><br />
        <p><strong>Department:</strong> <?= $member['department'] ?></p><br />
        <p><strong>About:</strong> <?= $member['about'] ?></p><br />
        <a href="?id=<?= $id ?>&generate_pdf=1" class="button" style="margin-top: 20px;" target="_blank">Generate PDF Report</a>
      </div>
    </div>
  </div>
</body>
</html>

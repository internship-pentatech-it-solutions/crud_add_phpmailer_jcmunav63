<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /crud_add_pdf_project_jcmunav63/index.php');
?>

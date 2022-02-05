<?php
  session_start();
  session_unset();
  session_destroy();
  //  Reincarc "index.php"
  header('Location: index.php');
?>
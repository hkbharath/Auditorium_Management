<?php
session_start();
  session_unset();
  session_destroy();
  session_write_close();
  header("Location: login.php?id=1");
?>

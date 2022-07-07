<?php
  session_start();
  $_SESSION['status_user_login'] = false;
  
  echo '<script>window.location = "index.php"</script>';
?>
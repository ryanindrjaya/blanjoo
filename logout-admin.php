<?php
  session_start();
  $_SESSION['status_admin_login'] = false;

  echo '<script>window.location = "produk.php"</script>';
?>
<?php
session_start();
error_reporting(0);
if ($_SESSION['status_user_login']) {
  echo "<script>alert('Harap logout dari user untuk melanjutkan sebagai admin.');</script>";
  echo "<script>window.location = 'produk.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="asset/logooo.png" type="image/png">
  <title>Login | Blanjoo</title>
</head>

<body id="bg-login">
  <div class="image">
    <img src="asset/Login Colour/login.png" alt="illustration">
  </div>
  <div class="box-login">
    <h2>Login admin Blanjoo!</h2>
    <form action="" method="POST">
      <input type="text" name="user" class="input" placeholder="Username">
      <input type="password" name="pass" class="input" placeholder="Password"> <br>
      <input type="submit" class="submit" name="submit" value="Login">
    </form>
    <?php
    // Membuat Autentikasi dari data di database dengan input login.
    if (isset($_POST['submit'])) {
      include 'db.php';

      $username = mysqli_real_escape_string($conn, $_POST['user']);
      $pass = mysqli_real_escape_string($conn, $_POST['pass']);

      $auth = mysqli_query($conn, "SELECT * FROM tb_seller WHERE username = '" . $username . "' AND password = '" . MD5($pass) . "' ");
      if (mysqli_num_rows($auth) > 0) {
        $d = mysqli_fetch_object($auth);
        $_SESSION['status_admin_login'] = true;
        $_SESSION['seller_global'] = $d;
        $_SESSION['admin_id'] = $d->seller_id;

        echo '<script>window.location = "dashboard.php"</script>';
      } else {
        echo '<script>alert("Username atau password anda salah!")</script>';
      }
    }
    ?>
  </div>
</body>

</html>
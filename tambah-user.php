<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="asset/logooo.png" type="image/png">
  <title>Buat akun | Blanjoo</title>

  <style>
    #bg-login {
      padding: 50px;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .box-login {
      position: static;
      z-index: 3!important;
    }

    .box-login-container {
      padding: 50px;
    }
  </style>
</head>

<body id="bg-login">
  <div class="box-login-container">
    <div class="box-login">
      <h2>Buat akun Blanjoo!</h2>
      <form action="" method="POST">
        <label for="name">Nama lengkap</label>
        <input type="text" name="name" id="name" class="input" placeholder="Nama lengkap" required>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="input" placeholder="Username" required>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" class="input" placeholder="E-mail" required>
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="input" placeholder="Alamat" required>
        <div class="mb-3">
          <label for="pw1" class="form-label">Password</label>
          <input type="password" class="input" id="pw1" name="pw1" required required>
        </div>
        <div class="mb-3">
          <label for="pw2" class="form-label">Konfirmasi password</label>
          <input type="password" class="input" name="pw2" id="pw2" required required>
        </div>
        <input type="submit" class="submit" name="submit" value="Buat akun">
      </form>
      <?php
      // Membuat Autentikasi dari data di database dengan input login.
      if (isset($_POST['submit'])) {
        include 'db.php';
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $name = $_POST['name'];
        $pw1 = MD5($_POST['pw1']);
        $pw2 = MD5($_POST['pw2']);
  
        if ($pw1 != $pw2) {
          echo '<script>alert("Password tidak sama!")</script>';
        } else {
          $tambah_user = mysqli_query($conn, "INSERT INTO tb_user VALUES (
            NULL,
            '".$name."',
            '".$username."',
            '".$pw1."',
            '".$email."',
            '".$alamat."'
          )");
  
          if($tambah_user) {
            echo '<script>alert("Berhasil membuat akun, silahkan login.")</script>';
            echo '<script>window.location = "login-user.php";</script>';
          } else {
            echo '<script>alert("Gagal membuat akun")</script>';
          }
        }
      }
      ?>
    </div>
  </div>

</body>

</html>
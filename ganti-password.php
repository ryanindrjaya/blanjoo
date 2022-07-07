<?php
session_start();
include 'db.php';
if ($_SESSION['status_admin_login'] != true) {
  echo '<script>window.location = "login-admin.php"</script>';
}

$query = mysqli_query($conn, "SELECT * FROM tb_seller WHERE seller_id = '" . $_SESSION['admin_id'] . "' ");
$d = mysqli_fetch_object($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/f540826c4d.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="asset/favicon.png" type="image/png">
  <title>Ubah password | Blanjoo</title>
</head>

<body id="dashboard">
  
  <main class="container=fluid">
    <div class="row">
      <?php require('components/header-dashboard.php') ?>

      <div class="col-md-10 p-4 vh-100">
        <div class="row form-section g-0">
          <div class="col-md-12 mb-3">
            <h1 class="p-2 text-white bg-primary card">Ganti password</h1>
          </div>
          <form action="" class="card p-4 shadow-sm" method="POST">
            <div class="form">
              <div class="mb-3">
                <label for="pw1" class="form-label">Password baru</label>
                <input type="password" class="form-control" id="pw1" name="pw1" required>
              </div>
              <div class="mb-3">
                <label for="pw2" class="form-label">Konfirmasi password</label>
                <input type="password" class="form-control" name="pw2" id="pw2" required>
              </div>
              <button type="submit" name="ubah_password" value="ubah-profil" class="btn btn-primary">Ubah password</button>
            </div>
          </form>
    
          <!-- Script PHP untuk validasi password dan update password -->
          <?php
          if (isset($_POST['ubah_password'])) {
    
            $pw1 = MD5($_POST['pw1']);
            $pw2 = MD5($_POST['pw2']);
    
            if ($pw1 != $pw2) {
              echo '<script>alert("Password tidak sama!")</script>';
            } else {
              $update_pw = mysqli_query($conn, "UPDATE tb_seller SET
                                      password = '" . $pw1 . "'
                                      WHERE seller_id = '" . $d->seller_id . "' ");
              if ($update_pw) {
                echo '<script>alert("Password anda berhasil diganti!")</script>';
                echo '<script>window.location = "profil.php";</script>';
              } else {
                echo 'Gagal megupdate password ' . mysqli_error($conn);
              }
            }
          }
          ?>
        </div>
      </div>
    </div>


  </main>

  <!-- FOOTER -->
  <?php require('components/footer-dashboard.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
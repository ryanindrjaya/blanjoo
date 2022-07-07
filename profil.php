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
  <title>Profil | Blanjoo</title>
</head>

<body id="dashboard">
  
  <main class="container-fluid">
    <div class="row">
      <?php require('components/header-dashboard.php') ?>

      <div class="col-md-10 p-4">
        <div class="row display-profil d-flex justify-content-center g-0 mb-4">
          <div class="col-md-12 mb-2">
            <h1 class="p-2 text-white bg-primary card">Profil</h1>
          </div>
          <div class="col-md-6 p-3 card shadow-lg">
            <div class="display-box border p-3">
              <p class="info-display">Nama lengkap</p>
              <p class="display-content">
                <?php echo $d->seller_name ?>
              </p>
            </div>
            <div class="display-box border p-3">
              <p class="info-display">E-mail</p>
              <p class="display-content">
                <?php echo $d->seller_email ?>
              </p>
            </div>
            <div class="display-box border p-3">
              <p class="info-display">Username</p>
              <p class="display-content">
                <?php echo $d->username ?>
              </p>
            </div>
            <div class="display-box border p-3">
              <p class="info-display">Nomor Handphone</p>
              <p class="display-content">
                <?php echo $d->seller_telp ?>
              </p>
            </div>
            <div class="display-box border p-3">
              <p class="info-display">Alamat</p>
              <p class="display-content">
                <?php echo $d->seller_address ?>
              </p>
            </div>
          </div>
        </div>

        <div class="row form-section g-0">
          <div class="col-md-12 mb-3">
            <h1 class="p-2 text-white bg-primary card">Edit Profil</h1>
          </div>
          <form action="" class="card p-4 shadow-sm" method="POST">
            <div class="form">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama lengkap</label>
                <input type="text" class="form-control" value="<?php echo $d->seller_name ?>" id="nama" name="nama" required>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" value="<?php echo $d->username ?>" name="username" id="username" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" value="<?php echo $d->seller_email ?>" name="email" id="email" required>
              </div>
              <div class="mb-3">
                <label for="no-telp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" value="<?php echo $d->seller_telp ?>" name="no-telp" id="no-telp" required>
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" value="<?php echo $d->seller_address ?>" name="alamat" id="alamat" required>
              </div>
              <button type="submit" name="submit" value="ubah-profil" class="btn btn-primary">Ubah</button>
              <span><a class="ubah-password" href="ganti-password.php" style="color: rgb(13,110,253); margin-left:15px;">Ganti Password</a></span>
            </div>
          </form>
    
          <!-- Script PHP untuk mengubah value dalam database dan mengganti nya dengan value input dari user -->
          <?php
          if (isset($_POST['submit'])) {
    
            $nama = ucwords($_POST['nama']);
            $username = $_POST['username'];
            $email = $_POST['email'];
            $no_telp = $_POST['no-telp'];
            $alamat = $_POST['alamat'];
    
            $update = mysqli_query($conn, "UPDATE tb_seller SET
                                    seller_name = '" . $nama . "',
                                    username    = '" . $username . "',
                                    seller_email= '" . $email . "',
                                    seller_telp = '" . $no_telp . "',
                                    seller_address = '" . $alamat . "'
                                    WHERE seller_id = '" . $d->seller_id . "' ");
            if ($update) {
              echo '<script>alert("Update profil berhasil!")</script>';
              echo '<script>window.location = "profil.php";</script>';
            } else {
              echo 'Gagal megupdate profil ' . mysqli_error($conn);
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
<?php
session_start();
include 'db.php';
if ($_SESSION['status_admin_login'] != true) {
  echo '<script>window.location = "login-admin.php"</script>';
}

$merk = mysqli_query($conn, "SELECT * FROM tb_merk WHERE merk_id = '".$_GET['id']."' ");
if(mysqli_num_rows($merk) == 0) {
  echo '<script>window.location = "data-merk.php"</script> ';
}
$k = mysqli_fetch_object($merk);
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
  <title>Ubah merk | Blanjoo</title>
</head>

<body id="dashboard">

  <main class="container-fluid">
    <div class="row">
      <?php require('components/header-dashboard.php') ?>

      <div class="col-md-10 p-4 vh-100">
        <div class="row form-section g-0">
          <div class="col-md-12 mb-3">
            <h1 class="p-2 text-white bg-primary card">Edit merk</h1>
          </div>
          <form action="" class="card p-4 shadow-sm" method="POST">
            <div class="form">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama merk</label>
                <input type="text" class="form-control" placeholder="Nama merk" value="<?php echo $k->merk_name?>" id="nama" name="nama" required>
              </div>
              <button type="submit" name="submit_edit" value="ubah-profil" class="btn btn-primary">Submit</button>
            </div>
          </form>
    
          <!-- Script PHP untuk mengubah value dalam database dan mengganti nya dengan value input dari user -->
          <?php
          if (isset($_POST['submit_edit'])) {
            $nama_baru = $_POST['nama'];
    
            $edit_merk = mysqli_query($conn, "UPDATE tb_merk SET merk_name = '" . $nama_baru . "' 
                                                  WHERE merk_id = '" . $k->merk_id . "'");
    
            if ($edit_merk) {
              echo '<script>alert("1 merk berhasil diedit!")</script>';
              echo '<script>window.location = "data-merk.php";</script>';
            } else {
              echo 'Gagal mengedit merk ' . mysqli_error($conn);
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
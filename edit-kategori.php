<?php
session_start();
include 'db.php';
if ($_SESSION['status_admin_login'] != true) {
  echo '<script>window.location = "login-admin.php"</script>';
}

$kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '" . $_GET['id'] . "' ");
if (mysqli_num_rows($kategori) == 0) {
  echo '<script>window.location = "data-kategori.php"</script> ';
}
$k = mysqli_fetch_object($kategori);
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
  <title>Ubah kategori | Blanjoo</title>
</head>

<body id="dashboard">

  <main class="container-fluid">
    <div class="row">
      <?php require('components/header-dashboard.php') ?>

      <div class="col-md-10 p-4 vh-100">
        <div class="row form-section g-0">
          <div class="col-md-12 mb-3">
            <h1 class="p-2 text-white bg-primary card">Edit kategori</h1>
          </div>
          <form action="" class="card p-4 shadow-sm" method="POST">
            <div class="form">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama kategori</label>
                <input type="text" class="form-control" placeholder="Nama Kategori" value="<?php echo $k->category_name ?>" id="nama" name="nama" required>
              </div>
              <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Kategori</label> <br>
                <img src="icon/<?php echo $k->category_image ?>" alt="" width="200px">
                <input type="hidden" name="foto" value="<?php echo $k->category_image ?>">
                <input type="file" class="form-control mt-2" name="gambar" id="gambar" value="<?php echo $k->category_image ?>">
              </div>
              <button type="submit" name="submit_edit" value="ubah-profil" class="btn btn-primary">Submit</button>
            </div>
          </form>

          <!-- Script PHP untuk mengubah value dalam database dan mengganti nya dengan value input dari user -->
          <?php
          if (isset($_POST['submit_edit'])) {
            $nama_baru = $_POST['nama'];

            // tampung data gambar baru
            $filename = $_FILES['gambar']['name'];
            $tmp_name = $_FILES['gambar']['tmp_name'];

            $type1 = explode('.', $filename);
            $type2 = $type1[1];

            $newname = 'kategori' . time() . '.' . $type2;

            // menampung data format file yang diizinkan
            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'PNG', 'JPEG', 'JPG', 'webp');

            // jika admin ganti gambar
            if ($filename != '') {

              if (!in_array($type2, $tipe_diizinkan)) {
                // Jika format file tidak ada di dalam tipe diizinkan
                echo '<script>alert("Format file tidak didukung!");</script>';
              } else {
                unlink('./icon/' . $foto);
                move_uploaded_file($tmp_name, './icon/' . $newname);
                $namagambar = $newname;
              }
            } else {
              // jika admin tidak ganti gambar
              $namagambar = $foto;
            }

            $edit_category = mysqli_query($conn, "UPDATE tb_category SET category_name = '" . $nama_baru . "', category_image = '".$namagambar."' 
                                                  WHERE category_id = '" . $k->category_id . "'");

            if ($edit_category) {
              echo '<script>alert("1 Kategori berhasil diedit!")</script>';
              echo '<script>window.location = "data-kategori.php";</script>';
            } else {
              echo 'Gagal mengedit kategori ' . mysqli_error($conn);
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
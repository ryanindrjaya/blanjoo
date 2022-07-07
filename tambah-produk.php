<?php
session_start();
include 'db.php';
if ($_SESSION['status_admin_login'] != true) {
  echo '<script>window.location = "login-admin.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="asset/favicon.png" type="image/png">
  <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
  <script src="https://kit.fontawesome.com/f540826c4d.js" crossorigin="anonymous"></script>
  <title>Tambah Produk | Blanjoo</title>
</head>

<body id="dashboard">

  <main class="container-fluid">
    <div class="row">
      <?php require('components/header-dashboard.php') ?>

      <div class="col-md-10 p-4">
        <div class="row form-section g-0">
          <div class="col-md-12 mb-3">
            <h1 class="p-2 text-white bg-success card">Tambah Produk</h1>
          </div>
          <form action="" class="card p-4 shadow-sm" method="POST" enctype="multipart/form-data">
            <div class="form">
              <div class="mb-3 form-group">
                <label for="kategori">Kategori Produk</label>
                <select class="form-control" name="kategori" id="kategori" required>
                  <option value="" class="text-center">-- Pilih Kategori --</option>
                  <?php
                  $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                  while ($r = mysqli_fetch_array($kategori)) {
                  ?>
                    <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3 form-group">
                <label for="merk">Merk Produk</label>
                <select class="form-control" name="merk" id="merk" required>
                  <option value="" class="text-center">-- Pilih Merk --</option>
                  <?php
                  $merk = mysqli_query($conn, "SELECT * FROM tb_merk ORDER BY merk_id DESC");
                  while ($m = mysqli_fetch_array($merk)) {
                  ?>
                    <option value="<?php echo $m['merk_id'] ?>"><?php echo $m['merk_name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama produk</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama produk..." name="nama" required>
              </div>
              <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" placeholder="Masukkan harga produk..." name="harga" id="harga" required>
              </div>
              <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Produk</label>
                <input type="file" class="form-control" name="gambar" id="gambar" required>
              </div>
              <div class="mb-3">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea class="form-control" placeholder="Masukkan deskripsi produk..." name="deskripsi" id="deskripsi" rows="20"></textarea>
              </div>
              <div class="mb-3 form-group">
                <label for="status">Status</label>
                <div class="form-control radio" name="status">
                  <input type="radio" name="status" value="1" checked />
                  <label for="ya">Aktif</label>
                  <input type="radio" name="status" value="0" />
                  <label for="tidak">Nonaktif</label>
                </div>
              </div>
              <button type="submit" name="submit_produk" value="Submit" class="btn btn-success">Tambah produk</button>
            </div>
          </form>
          <?php
          if (isset($_POST['submit_produk'])) {
            // menampung inputan dari form
            $kategori = $_POST['kategori'];
            $merk = $_POST['merk'];
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $deskripsi = $_POST['deskripsi'];
            $status = $_POST['status'];
    
            // menampung data file yang diupload
            $filename = $_FILES['gambar']['name'];
            $tmp_name = $_FILES['gambar']['tmp_name'];
    
            $type1 = explode('.', $filename);
            $type2 = $type1[1];
    
            $newname = 'produk' . time() . '.' . $type2;
    
            // menampung data format file yang diizinkan
            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'PNG', 'JPEG', 'JPG', 'webp');
            if (!in_array($type2, $tipe_diizinkan)) {
              // Jika format file tidak ada di dalam tipe diizinkan
              echo '<script>alert("Format file tidak didukung!");</script>';
            } else {
              // Jika format file sesuai dengan yang ada di dalam array tipe diizinkan
              //proses upload file sekaligus insert dalam database
              move_uploaded_file($tmp_name, './produk/' . $newname);
    
              $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES(
                                        NULL,
                                        '" . $kategori . "',
                                        '" . $merk . "',
                                        '" . $nama . "',
                                        " . $harga . ",
                                        '" . $deskripsi . "',
                                        '" . $newname . "',
                                        '" . $status . "',
                                        NULL
                )");
              if ($insert) {
                echo '<script>window.location = "data-produk.php";</script>';
              } else {
                echo '<script>alert("Gagal menambahkan produk!")</script>';
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

  <script>
    ClassicEditor
      .create(document.querySelector('#deskripsi'))
      .then(editor => {
        console.log(editor);
      })
      .catch(error => {
        console.error(error);
      });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
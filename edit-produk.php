<?php
session_start();
include 'db.php';
if ($_SESSION['status_admin_login'] != true) {
  echo '<script>window.location = "login-admin.php"</script>';
}

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '" . $_GET['id'] . "' ");
if (mysqli_num_rows($produk) == 0) {
  echo '<script>window.location = "data-produk.php";</script>';
}
$p = mysqli_fetch_object($produk);
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
  <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
  <title>Edit Produk | Blanjoo</title>
</head>

<body id="dashboard">

  <main class="container-fluid">
    <div class="row">
      <?php require('components/header-dashboard.php') ?>
      
      <div class="col-md-10 p-4 ">
        <div class="row form-section g-0">
          <div class="mb-3">
            <h1 class="p-2 text-white bg-success card">Edit Produk</h1>
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
                    <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id) ? 'selected' : '' ?>><?php echo $r['category_name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama produk</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $p->product_name ?>" required>
              </div>
              <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga" value="<?php echo $p->product_price ?>" required>
              </div>
              <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Produk</label> <br>
                <img src="produk/<?php echo $p->product_image ?>" alt="" width="200px">
                <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                <input type="file" class="form-control mt-2" name="gambar" id="gambar" value="<?php echo $p->product_image ?>">
              </div>
              <div class="mb-3">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="20"><?php echo $p->product_description ?></textarea>
              </div>
              <div class="mb-3 form-group">
                <label for="status">Status</label>
                <div class="form-control radio" name="status">
                  <input type="radio" name="status" value="1" <?php echo ($p->product_status == 1) ? 'checked' : '' ?> />
                  <label for="ya">Aktif</label>
                  <input type="radio" name="status" value="0" <?php echo ($p->product_status == 0) ? 'checked' : '' ?> />
                  <label for="tidak">Nonaktif</label>
                </div>
              </div>
              <button type="submit" name="submit_edit" value="Submit" class="btn btn-success">Edit produk</button>
            </div>
          </form>
          <?php
          if (isset($_POST['submit_edit'])) {
    
            // data inputan dari form
            $kategori   = $_POST['kategori'];
            $nama       = $_POST['nama'];
            $harga      = $_POST['harga'];
            $deskripsi  = $_POST['deskripsi'];
            $status     = $_POST['status'];
            $foto       = $_POST['foto'];
    
            // tampung data gambar baru
            $filename = $_FILES['gambar']['name'];
            $tmp_name = $_FILES['gambar']['tmp_name'];
    
            $type1 = explode('.', $filename);
            $type2 = $type1[1];
    
            $newname = 'produk' . time() . '.' . $type2;
    
            // menampung data format file yang diizinkan
            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'PNG', 'JPEG', 'JPG', 'webp');
    
            // jika admin ganti gambar
            if ($filename != '') {
    
              if (!in_array($type2, $tipe_diizinkan)) {
                // Jika format file tidak ada di dalam tipe diizinkan
                echo '<script>alert("Format file tidak didukung!");</script>';
              } else {
                unlink('./produk/' . $foto);
                move_uploaded_file($tmp_name, './produk/' . $newname);
                $namagambar = $newname;
              }
            } else {
    
              // jika admin tidak ganti gambar
              $namagambar = $foto;
            }
    
            // query update data produk
            $update = mysqli_query($conn, "UPDATE tb_product SET
                                  category_id = '" . $kategori . "', 
                                  product_name = '" . $nama . "', 
                                  product_price = " . $harga . ", 
                                  product_description = '" . $deskripsi . "', 
                                  product_image = '" . $namagambar . "', 
                                  product_status = '" . $status . "' 
                                  WHERE product_id = '" . $p->product_id . "'
                                  ");
            if ($update) {
    
              echo '<script>alert("Edit data berhasil!");</script>';
              echo '<script>window.location = "data-produk.php";</script>';
            } else {
              echo '<script>alert("Gagal mengedit produk!")</script>' . mysqli_error($conn);
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
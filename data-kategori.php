<?php
include 'db.php';

session_start();
if ($_SESSION['status_admin_login'] != true) {
  echo '<script>window.location = "login-admin.php"</script>';
}

$query = mysqli_query($conn, "SELECT * FROM tb_seller WHERE seller_id = '" . $_SESSION['admin_id'] . "' ");
$d = mysqli_fetch_object($query);

$query_kategori = mysqli_query($conn, "SELECT * FROM tb_category");
$k = mysqli_fetch_object($query_kategori);
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
  <title>Data Kategori | Blanjoo</title>
</head>

<body>
  
  <main class="container-fluid">
    <div class="row">
      <?php require('components/header-dashboard.php') ?>

      <div class="col-md-10 p-4 vh-100">
        <div class="row">
          <div class="col-md-12">
            <h4>Data kategori</h4>
          </div>
          <div class="col-md-12">
            <button class="btn btn-success" onclick="showHideDiv()"><a>+ Tambah kategori</a></button>
            <div class="mb-3 mt-4 tambah-category" id="tambahCategory" style="display: none;">
              <form action="" method="POST" enctype="multipart/form-data">
                <label for="nama" class="form-label">Nama kategori</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
                <div class="mb-3">
                  <label for="gambar" class="form-label mt-2">Ikon kategori</label>
                  <input type="file" class="form-control" name="gambar" id="gambar" required>
                </div>
                <input type="submit" name="submit" value="+ Tambah" class="mt-2 btn text-success">
              </form>
              <?php
              if (isset($_POST['submit'])) {
                $nama = $_POST['nama'];
    
                $filename = $_FILES['gambar']['name'];
                $tmp_name = $_FILES['gambar']['tmp_name'];
    
                $type1 = explode('.', $filename);
                $type2 = $type1[1];
    
                $newname = 'kategori' . time() . '.' . $type2;
    
                $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'PNG', 'JPEG', 'JPG');
                if (!in_array($type2, $tipe_diizinkan)) {
                  // Jika format file tidak ada di dalam tipe diizinkan
                  echo '<script>alert("Format file tidak didukung!");</script>';
                } else {
                  // Jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                  //proses upload file sekaligus insert dalam database
                  move_uploaded_file($tmp_name, './icon/' . $newname);
    
                  $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (NULL, '" . $nama . "', '" . $newname . "') ");
                  if ($insert) {
                    echo '<script>window.location = "data-kategori.php";</script>';
                  } else {
                    echo '<script>alert("Gagal menambahkan kategori!")</script>' . mysqli_error($conn);
                  }
                }
              }
              ?>
            </div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <td>ID</td>
                  <td>Nama Kategori</td>
                  <td>Gambar Kategori</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                if (mysqli_num_rows($kategori) > 0) {
                  while ($row = mysqli_fetch_array($kategori)) {
                ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo ucwords($row['category_name']) ?></td>
                      <td><a href="icon/<?php echo $row['category_image'] ?>" target="_blank"><img src="icon/<?php echo $row['category_image'] ?>" alt="" width="50px"></a></td>
                      <td class="text-white">
                        <button class="btn btn-success mx-1"><a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>">Edit</a></button>
                        <button class="btn btn-danger"><a href="hapus.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Yakin ingin hapus kategori ini?')">Hapus</a></button>
                      </td>
                    </tr>
                  <?php }
                } else { ?>
                  <tr>
                    <td colspan="3">Tidak ada data</td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  <?php require('components/footer-dashboard.php') ?>

  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
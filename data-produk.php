<?php
include 'db.php';

session_start();
if ($_SESSION['status_admin_login'] != true) {
  echo '<script>window.location = "login-admin.php"</script>';
}

$query = mysqli_query($conn, "SELECT * FROM tb_seller WHERE seller_id = '" . $_SESSION['admin_id'] . "' ");
$d = mysqli_fetch_object($query);

$query_produk = mysqli_query($conn, "SELECT * FROM tb_product");
$p = mysqli_fetch_object($query_produk);
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
  <title>Data Produk | Blanjoo</title>
</head>

<body>
  
  <main class="container-fluid">
    <div class="row">
      <?php require('components/header-dashboard.php') ?>

      <div class="col-md-10 p-4 vh-100">
        <div class="row">
          <div class="col-sm-12">
            <h4>Data Produk</h4>
          </div>
          <div class="col-sm-12">
            <button class="btn btn-success"><a href="tambah-produk.php">+ Tambah produk</a></button>
            <table class="table table-hover">
              <thead>
                <tr>
                  <td>ID</td>
                  <td>Kategori</td>
                  <td>Merk</td>
                  <td>Nama produk</td>
                  <td>Harga</td>
                  <td>Gambar</td>
                  <td>Status</td>
                  <td>Tanggal dibuat</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) LEFT JOIN tb_merk USING (merk_id) ORDER BY product_id DESC");
                if (mysqli_num_rows($produk) > 0) {
                  while ($row = mysqli_fetch_array($produk)) {
                ?>
                    <tr class="data-produk h-100">
                      <td><?php echo $no++ ?></td>
                      <td><?php echo ucwords($row['category_name']) ?></td>
                      <td><?php echo ucwords($row['merk_name']) ?></td>
                      <td><?php echo ucwords($row['product_name']) ?></td>
                      <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                      <td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"><img src="produk/<?php echo $row['product_image'] ?>" alt="" width="50px"></a></td>
                      <td><?php echo ($row['product_status'] == 0) ? 'Nonaktif' : 'Aktif' ?></td>
                      <td><?php echo $row['date_created'] ?></td>
                      <td class="text-white d-flex h-100">
                        <button class="btn btn-success mx-1"><a href="edit-produk.php?id=<?php echo $row['product_id'] ?>">Edit</a></button>
                        <button class="btn btn-danger"><a href="hapus.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</a></button>
                      </td>
                    </tr>
                  <?php }
                } else { ?>
                  <tr>
                    <td colspan="8">Tidak ada data</td>
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

  <script src="js/script.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
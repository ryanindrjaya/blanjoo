<?php
session_start();
error_reporting(0);
include 'db.php';

$data_transaksi_produk = mysqli_query($conn, "SELECT * FROM transaksi_produk JOIN tb_product ON transaksi_produk.id_product=tb_product.product_id WHERE id_transaksi = '" . $_GET['id'] . "' ");
$data_pembeli = mysqli_query($conn, "SELECT * FROM tb_transaksi JOIN tb_user ON tb_transaksi.id_user=tb_user.user_id JOIN ongkir ON tb_transaksi.id_ongkir=ongkir.id_ongkir WHERE id_transaksi = '" . $_GET['id'] . "' ");
$pembeli = mysqli_fetch_object($data_pembeli);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/f540826c4d.js" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="icon" href="asset/favicon.png" type="image/png">
  <title>Checkout | Blanjoo</title>

</head>

<body id="beranda">

  <!-- HEADER -->
  <?php require('components/header-index.php') ?>

  <!-- PRODUK DETAIL -->
  <div class="container" style="margin-top: 8rem;">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-5 card w-100 shadow-lg p-0">
        <div class="row p-0 w-100">
          <div class="col-md-12 p-4">
            <h2 class="cart-titte display-4 mb-2" style="margin-left: 20px;">Detail transaksi</h2>
            <hr>

            <div class="detail-pembeli alert alert-primary">
              <table class="table table-borderless" style="font-size: 17px!important;">
                <tr>
                  <td>Nama pembeli</td>
                  <td>: <strong><?php echo $pembeli->user_name ?></strong></td>
                </tr>
                <tr>
                  <td>Email pembeli</td>
                  <td>: <strong><?php echo $pembeli->user_email ?></strong></td>
                </tr>
                <tr>
                  <td>Alamat pembeli</td>
                  <td>: <strong><?php echo $pembeli->user_address ?></strong></td>
                </tr>
                <tr>
                  <td>Pengiriman</td>
                  <td>: <strong><?php echo $pembeli->nama_kota ?> - Rp. <?php echo number_format($pembeli->harga_ongkir) ?></strong></td>
                </tr>
                <tr>
                  <td>Tanggal transaksi</td>
                  <td>: <strong><?php echo $pembeli->tanggal_transaksi; ?></strong></td>
                </tr>
              </table>
            </div>

            <hr>
            <?php
            $total_belanja = 0;
            while ($t = mysqli_fetch_array($data_transaksi_produk)) {
              $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) LEFT JOIN tb_merk USING (merk_id) WHERE product_id = '" . $t['id_product'] . "' ");
              $p = mysqli_fetch_array($produk);
              $sub_harga = $t['product_price'] * $t['jumlah'];
            ?>
              <div class="item-produk d-flex justify-content-between mb-4">
                <img class="border" src="produk/<?php echo $t['product_image'] ?>" alt="<?php echo $p['product_name'] ?>" style="height: 130px;">
                <div class="data-produk">
                  <p class="fs-4 text-dark mb-0"><?php echo $t['product_name'] ?></p>
                  <a href="produk.php?kat=<?php echo $t['category_id'] ?>" class="text-muted" style="margin-right: 6px; font-size: 14px"><?php echo $p['category_name'] ?></a>
                  <a href="produk.php?merk=<?php echo $t['merk_id'] ?>" class="text-muted" style="margin-left: 6px; font-size: 14px;"><?php echo $p['merk_name'] ?></a>
                </div>
                <p>Rp. <?php echo number_format($t['product_price']) ?></p>
                <p><?php echo $t['jumlah'] ?></p>
                <p class="text-primary">Rp. <?php echo number_format($sub_harga) ?></p>
              </div>
            <?php
              $total_belanja += $sub_harga;
            }
            ?>
            <hr>
            <div class="total d-flex justify-content-between">
              <h3 class="text-dark">Total belanja</h3>
              <p class="text-primary fs-4">Rp. <?php echo number_format($total_belanja) ?></p>
            </div>
          </div>
        </div>
      </div>
      <?php
      if ($_SESSION['status_admin_login']) {
      ?>
        <a href="data-transaksi.php" class="btn btn-primary mt-2">Kembali</a>
      <?php
      } else {
      ?>
        <a href="produk.php" class="btn btn-primary mt-2">Kembali</a>
      <?php
      }
      ?>
    </div>
  </div>

  <!-- Footer -->
  <?php require('components/footer-index.php') ?>
  <script type="text/javascript">
  </script>

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
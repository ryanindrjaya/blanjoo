<?php
session_start();
error_reporting(0);
include 'db.php';

if ($_SESSION['status_user_login'] != true) {
  echo '<script>alert("Harap login untuk melakukan checkout.");</script>';
  echo '<script>window.location = "cart.php"</script>';
}

$user = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '" . $_SESSION['user_id'] . "' ");
$u = mysqli_fetch_object($user);

$ongkir = mysqli_query($conn, "SELECT * FROM ongkir");
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
            <h2 class="cart-titte display-4 mb-2" style="margin-left: 20px;">Checkout</h2>

            <hr>
            <?php
            if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
            ?>
              <p>Keranjang anda kosong...</p>
            <?php
            } else {
            ?>
              <?php
              $total_belanja = 0;
              foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) :
                $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) LEFT JOIN tb_merk USING (merk_id) WHERE product_id = '" . $id_produk . "' ");
                $p = mysqli_fetch_array($produk);
                $sub_harga = $p['product_price'] * $jumlah;
              ?>
                <div class="item-produk d-flex justify-content-between mb-4">
                  <img class="border" src="produk/<?php echo $p['product_image'] ?>" alt="<?php echo $p['product_name'] ?>" style="height: 130px;">
                  <div class="data-produk">
                    <p class="fs-4 text-dark mb-0"><?php echo $p['product_name'] ?></p>
                    <a href="produk.php?kat=<?php echo $p['category_id'] ?>" class="text-muted" style="margin-right: 6px; font-size: 14px"><?php echo $p['category_name'] ?></a>
                    <a href="produk.php?merk=<?php echo $p['merk_id'] ?>" class="text-muted" style="margin-left: 6px; font-size: 14px;"><?php echo $p['merk_name'] ?></a>
                  </div>
                  <p>Rp. <?php echo number_format($p['product_price']) ?></p>
                  <p><?php echo $jumlah ?></p>
                  <p class="text-primary">Rp. <?php echo number_format($sub_harga) ?></p>
                </div>
              <?php
                $total_belanja += $sub_harga;
              endforeach
              ?>
            <?php
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

      <form action="" method="POST">
        <div class="col-md-12 mt-4 card shadow-lg p-4">
          <div class="header d-flex justify-content-between">
            <div class="title">
              <h2 class="fw-bold">Hi <?php echo $u->user_name ?></h2>
              <p>Thank you for your order!</p>
            </div>
            <h1 class="display-3 font-weight-bold">Blanjoo!</h1>
          </div>

          <hr>

          <div class="detail-pengiriman mt-4 d-flex w-100">
            <div class="alamat w-50" style="padding-right: 10px;">
              <h4 class="text-dark">Data penerima</h4>
              <input type="text" readonly value="<?php echo $u->user_name ?>" class="form-control w-60 mb-2">
              <input type="text" readonly value="<?php echo $u->user_email ?>" class="form-control w-60 mb-2">
              <input type="text" readonly value="<?php echo $u->user_address ?>" class="form-control w-60">
            </div>
            <div class="ongkir w-50" style="padding-left: 10px;">
              <h4 class="text-dark">Pengiriman</h4>
              <select name="ongkir" class="form-control" id="ongkir" required>
                <option value="">Pilih ongkos kirim</option>
                <?php
                while ($o = mysqli_fetch_array($ongkir)) {
                ?>
                  <option value="<?php echo $o['id_ongkir']; ?>">
                    <?php echo $o['nama_kota']; ?> - Rp. <?php echo number_format($o['harga_ongkir']); ?>
                  </option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <button name="checkout" class="btn btn-primary mt-4">Checkout</button>
        </div>
      </form>

      <?php
      if (isset($_POST['checkout'])) {
        $user_id = $u->user_id;
        $ongkir = $_POST['ongkir'];
        $tanggal_transaksi = date("Y-m-d");

        $query_ongkir = mysqli_query($conn, "SELECT * FROM ongkir WHERE id_ongkir ='$ongkir' ");
        $data_ongkir = mysqli_fetch_object($query_ongkir);

        $total_transaksi = $total_belanja + $data_ongkir->harga_ongkir;

        // insert data ke tabel tb_transaksi
        $transaksi = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES (
          NULL,
          '" . $user_id . "',
          '" . $ongkir . "',
          '" . $tanggal_transaksi . "',
          '" . $total_transaksi . "'
        );");

        // mendapatkan id dari tiap transaksi yang terjadi
        $id_transaksi = mysqli_insert_id($conn);

        // insert data ke tabel transaksi_produk
        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
          $transaksi_produk = mysqli_query($conn, "INSERT INTO transaksi_produk VALUES(
            NULL,
            " . $id_transaksi . ",
            " . $id_produk . ",
            " . $jumlah . "
          );");
        }

        // mereset/mengkosongkan keranjang belanja
        unset($_SESSION['keranjang']);

        echo "<script>alert('Produk berhasil dibeli!');</script>";
        echo "<script>window.location = 'nota.php?id=$id_transaksi'</script>";
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
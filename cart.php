<?php
session_start();
error_reporting(0);
include 'db.php';
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
  <title>Cart | Blanjoo</title>

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
            <h2 class="cart-titte display-4 mb-2" style="margin-left: 20px;">Cart</h2>

            <hr>
            <?php
            if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])) {
            ?>
              <p>Keranjang anda kosong...</p>
            <?php
            } else {
            ?>
              <?php
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
                  <div class="action">
                    <a href="hapus-cart-item.php?id=<?php echo $id_produk ?>" class="btn text-white bg-danger px-3 py-1">X</a>
                  </div>
                </div>
              <?php endforeach ?>
            <?php
            }
            ?>
            <hr>
          </div>
        </div>
      </div>

      <div class="link mt-5 p-0 w-100 d-flex justify-content-between">
        <a href="produk.php" class="btn btn-default">Explore product</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
      </div>
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
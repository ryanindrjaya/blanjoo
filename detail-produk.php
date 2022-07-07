<?php
error_reporting(0);
include 'db.php';

$admin = mysqli_query($conn, "SELECT seller_telp FROM tb_seller WHERE seller_id = 1");
$a = mysqli_fetch_object($admin);

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '" . $_GET['id'] . "' ");
$p = mysqli_fetch_object($produk);
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
  <title>Produk | Blanjoo</title>

</head>

<body id="beranda">

  <!-- HEADER -->
  <?php require('components/header-index.php') ?>

  <!-- PRODUK DETAIL -->
  <div class="container" style="margin-top: 8rem;">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-5">
        <img src="produk/<?php echo $p->product_image ?>" class="image-fluid rounded shadow" alt="Gambar produk" width="100%">
      </div>
      <div class="col-md-12 col-lg-5 p-3 mx-3">
        <h3 class="display-5"><?php echo substr($p->product_name, 0, 30) ?></h3>
        <h5 class="mt-2 price border-bottom pb-2 border-primary"><b>Rp. <?php echo number_format($p->product_price); ?></b></h5>
        <p class="product-description" style="text-align: justify;">
          <?php echo $p->product_description ?>
        </p>
        <div class="action-button pt-2 w-100">
          <a style="width: 18rem;" href="add-to-cart.php?id=<?php echo $p->product_id ?>" class="btn btn-primary color-white d-inline-flex align-items-center">
            <i class="fa-solid fa-cart-arrow-down mx-2 fs-5"></i>Tambahkan ke keranjang
          </a>
          <a style="width: 18rem;" target="_blank" href="https://api.whatsapp.com/send?phone=62<?php echo $a->seller_telp ?>&text=Halo, saya tertarik dengan produk <?php echo $p->product_name ?> anda" class="btn mt-3 btn-success color-white d-inline-flex align-items-center">
            <i class="fa-brands fa-whatsapp mx-2 fs-5"></i>Hubungi via WhatsApp
          </a>
        </div>
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
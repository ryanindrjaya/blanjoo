<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/f540826c4d.js" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="asset/favicon.png" type="image/png">
  <style>
    html {
      scroll-behavior: smooth;
    }

    .card-img-top {
      width: 100%;
      height: 15vw;
      object-fit: cover;
    }

    /* STYLING BANNER */
    .banner1-container {
      position: relative;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: black;
      overflow: hidden;
    }

    .banner1-content {
      position: absolute;
      top: 40%;
      left: 5%;
      text-align: center;
    }

    .banner1-img {
      position: absolute;
      right: 8.5%;
      bottom: -10%;
    }

    .banner2-container {
      position: relative;
      width: 100%;
      height: 100vh;
      color: white;
    }

    .banner2-container video {
      width: 100%;
      height: 100vh;
      object-fit: cover;
    }

    .banner3-container {
      position: relative;
      margin: 10px;
      border-radius: 20px;
      background-image: url('https://www.apple.com/v/iphone/home/bh/images/overview/subhero/guided_tour__c40f88on9o8y_large.jpg');
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
    }

    .banner3-content {
      position: absolute;
      top: 40%;
      left: 32%;
      transform: translate(-50%, -50%);
      color: white;
    }

    .banner3-content h1,
    .banner3-container p {
      font-size: 3.8rem;

    }

    .title {
      text-shadow: 6px 6px 0px rgba(0, 0, 0, 0.2);
    }

    .banner2-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 3;
    }

    .fade-bottom {
      position: absolute;
      bottom: 0;
      z-index: 9;
      width: 100%;
      height: 7.4rem;
      background-image: linear-gradient(180deg,
          transparent,
          rgba(0, 0, 0, 0.71),
          black);
    }

    .overlay {
      width: 100%;
      height: 100vh;
      background: black;
      position: absolute;
      opacity: 0.5;
      z-index: 1;
    }
  </style>
  <title>Beranda | Blanjoo</title>
</head>

<body id="beranda">

  <!-- HEADER -->
  <?php require('components/header-homepage.php') ?>

  <!-- BANNER 1 -->
  <div class="banner2-container">
    <div class="banner2-content text-center">
      <h1 class="title display-1 mb-5 font-weight-bold">Blanjoo!</h1>
      <h2 class="sub-title display-5 fs-3 mb-5">Your affordable gadget marketplace.</h2>
      <a href="produk.php" class="btn btn-lg btn-light text-dark mx-3">Explore our product.</a>
      <a href="#banner3" class="btn btn-lg btn-light text-dark mx-3">Search our product.</a>
    </div>
    <div class="overlay"></div>
    <video src="asset/banner-video.mp4" autoplay="true" loop muted></video>
    <div class="fade-bottom"></div>
  </div>


  <!-- BANNER 2 -->
  <div class="container-fluid banner1-container">
    <div class="banner1-content">
      <div class="banner1-title">
        <h1 class="display-3"><i class="fa-brands fa-apple mx-3"></i>iPhone 13 Pro</h1>
      </div>
      <div class="banner1-text">
        <p>Kini tersedia.</p>
        <p>Mulai dari Rp 770.792/ bulan</p>
      </div>
      <div class="banner1-button">
        <a href="produk.php" class="btn btn-outline-dark text-light">Telusuri lebih lanjut</a>
      </div>
    </div>
    <img src="asset/banner2-index.png" class="banner1-img" alt="">
  </div>

  <div class="vh-100 banner3-container" id="banner3">
    <div class="banner3-content">
      <h1>Jadilah yang terdepan</h1>
      <p class="" style="margin-bottom: 25px;">Temukan gadgetmu.</p>
      <?php require('components/search.php'); ?>
    </div>
  </div>

  <?php require('components/kategori-index.php') ?>

  <!-- NEW PRODUCT -->
  <div class="container">
    <h5 class="mt-3 text-primary">Produk Terbaru</h5>
    <div class="row d-flex flex-row justify-content-evenly">
      <?php
      $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 5");
      if (mysqli_num_rows($produk) > 0) {
        while ($p = mysqli_fetch_array($produk)) {
      ?>
          <div id="card" class="card produk-card shadow-sm col-lg-3 my-3 p-2" style="width: 13rem; border: 0.5px solid rgba(13, 109, 253, 0.543);">
            <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>" style="color: black;">
              <img src="produk/<?php echo $p['product_image']; ?>" class="card-img-top" alt="Gambar produk">
              <div class="card-body" style="padding: 5px;">
                <h6 class="card-title mt-2"><?php echo substr($p['product_name'], 0, 30); ?></h6>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item harga" style="color: #C70039; text-align: right;">Rp. <?php echo number_format($p['product_price']) ?></li>
              </ul>
            </a>
          </div>
        <?php }
      } else { ?>
        <p>Produk tidak ada</p>
      <?php } ?>
    </div>
  </div>

  <!-- FOOTER -->
  <?php require('components/footer-index.php') ?>

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
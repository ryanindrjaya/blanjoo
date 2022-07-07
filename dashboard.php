<?php
include 'db.php';

session_start();
if ($_SESSION['status_admin_login'] != true) {
  echo '<script>window.location = "login-admin.php"</script>';
}

$query = mysqli_query($conn, "SELECT * FROM tb_seller WHERE seller_id = '" . $_SESSION['admin_id'] . "' ");
$d = mysqli_fetch_object($query);

$produk = mysqli_query($conn, "SELECT product_name FROM tb_product WHERE product_status = 1");
$user = mysqli_query($conn, "SELECT user_name FROM tb_user");

$produk_terjual = mysqli_query($conn, "SELECT SUM(jumlah) as produk_terjual FROM transaksi_produk");
$p = mysqli_fetch_object($produk_terjual);

$data_transaksi = mysqli_query($conn, "SELECT SUM(total_transaksi) as pendapatan FROM tb_transaksi");
$t = mysqli_fetch_object($data_transaksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/f540826c4d.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="asset/favicon.png" type="image/png">
  <title>Dashboard | Blanjoo</title>

  <style>
    .data-container {
      display: flex;
      justify-content: space-between;
      margin-bottom: 40px;
    }

    .data-item {
      min-width: 20%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
      transition: 0.3s;    
    }

    .data-item:hover {
      box-shadow: rgba(149, 157, 165, 0.5) 0px 8px 24px;
    }

    .data-item h4, .data-item p {
      margin-top: 10px;
      text-align: center;
    }

    .icon {
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 20px;
    }

    .data {
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
    }

    .icon i{
      font-size: 36px;
    }

    .data h4 {
      font-weight: 700;
    }
  </style>
</head>

<body id="dashboard">

  <!-- HEADER -->

  <main class="container-fluid">
    <div class="row">
      <?php require('components/header-dashboard.php') ?>

      <div class="col-md-10 p-4">
        <div class="p-5 mb-4 bg-light rounded-3 heading">
          <div class="container-fluid py-5 px-4 text-content">
            <h1 class="display-5 fw-bold">Selamat datang di Blanjoo! <br> <?php echo $d->seller_name; ?></h1>
            <p class="col-md-8 fs-4">Ini adalah dashboard admin anda!</p>
          </div>
        </div>

        <div class="row gy-sm-4 align-items-md-stretch">
          <div class="col-md-12">
            <h2>Analytics</h2>
          </div>
          <div class="col-md-12 data-container">
            <div class="data-item card">
              <div class="icon">
                <i class="fa-solid fa-coins text-warning"></i>
              </div>
              <div class="data">
                <h4>Rp. <?php echo number_format($t->pendapatan); ?></h4>
                <p>Total pendapatan</p>
              </div>
            </div>
            <div class="data-item card">
              <div class="icon">
                <i class="fa-solid fa-laptop-file mx-2 mb-md-3 text-info"></i>
              </div>
              <div class="data">
                <h4><?php echo mysqli_num_rows($produk); ?></h4>
                <p>Produk aktif</p>
              </div>
            </div>
            <div class="data-item card">
              <div class="icon">
                <i class="fa-solid fa-money-bill-transfer mx-1 mb-md-3 text-success"></i>
              </div>
              <div class="data">
                <h4><?php echo $p->produk_terjual; ?></h4>
                <p>Produk terjual</p>
              </div>
            </div>
            <div class="data-item card">
              <div class="icon">
                <i class="fa-solid fa-users mx-2 mb-md-3 text-primary"></i>
              </div>
              <div class="data">
                <h4><?php echo mysqli_num_rows($user); ?></h4>
                <p>User</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row gy-sm-4 align-items-md-stretch">
          <div class="col-md-6">
            <div class="h-100 p-5 d-flex flex-column justify-content-between text-white bg-dark rounded-3">
              <h2>Data Produk</h2>
              <p>Masukkan data produk - produk yang akan anda jual!</p>
              <a class="btn btn-outline-light" href="data-produk.php" type="button">Go</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="h-100 p-5 d-flex flex-column justify-content-between bg-light border rounded-3">
              <h2>Data Kategori</h2>
              <p>Atur kategori produk - produk anda agar lebih mudah untuk dicari!</p>
              <a href="data-kategori.php" class="btn btn-outline-secondary" type="button">Go</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
  </main>

  <!-- FOOTER -->
  <?php require('components/footer-dashboard.php') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
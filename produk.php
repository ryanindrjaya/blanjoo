<?php
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
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://kit.fontawesome.com/f540826c4d.js" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="icon" href="asset/favicon.png" type="image/png">
  <style>
    .card-img-top {
      width: 100%;
      height: 15vw;
      object-fit: cover;
    }

    /* ---------FILTER (product.php)-------- */
    .dropdown {
      width: 100%;
      margin: 0 auto;
      border: none;
      border-bottom: 1px solid #9A9A9A;
      padding-bottom: 8px;
      outline: none;
      transition: 0.2s;
    }

    ::-webkit-input-placeholder {
      font-size: 13px !important;
    }


    .dropdown:focus {
      border: none;
      outline: none;
      border-bottom: 3px solid black;
    }
  </style>
  <title>Produk | Blanjoo</title>
</head>

<body id="beranda">

  <?php require('components/header-index.php') ?>

  <div class="container-fluid px-3" style="margin-top: 7rem;">
    <div class="row d-flex mt-3 justify-content-between">
      <?php require('components/search.php'); ?>
      <div class="col-lg-3 mt-3 filter">
        <form class="p-3 card border shadow-sm" action="produk.php">
          <h5 class="text-primary">Filter</h5>
          <div class="filter-form mt-3 d-flex flex-column justify-content-center">
            <small class="form-text d-block text-muted">Kategori</small>
            <!-- Jadikan dinamis!! -->
            <select name="kat" class="mt-2 dropdown w-80" id="filter-kategori">
              <option value=''>Semua</option>
              <?php
              $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
              while ($k = mysqli_fetch_array($kategori)) {
              ?>
                <option value="<?php echo $k['category_id']; ?>"><?php echo $k['category_name'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="filter-form mt-3 d-flex flex-column justify-content-center">
            <small class="form-text d-block text-muted">Merk</small>
            <!-- Jadikan dinamis!! -->
            <select name="merk" class="mt-2 dropdown w-80" id="filter-merk">
              <option value=''>Semua</option>
              <?php
              $merk = mysqli_query($conn, "SELECT * FROM tb_merk ORDER BY merk_id DESC");
              while ($m = mysqli_fetch_array($merk)) {
              ?>
                <option value="<?php echo $m['merk_id']; ?>"><?php echo $m['merk_name'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="filter-form d-flex flex-column mt-4">
            <small class="form-text text-muted">Harga</small>
            <input type="number" class="mt-2 dropdown" placeholder="Harga Minimal" name="hargaMin">
            <input type="number" class="mt-2 dropdown" placeholder="Harga maksimal" name="hargaMax">
          </div>
          <div class="filter-submit d-flex justify-content-center">
            <button type="submit" name="submit" class="btn btn-outline-dark mt-4">Cari</button>
          </div>
        </form>
      </div>

      <div class="col-lg-9">
        <!-- DATA PRODUK -->
        <div class="container px-0">
          <h5 class="mt-3 text-primary">Produk</h5>
          <div class="row d-flex flex-row justify-content-start">
            <?php
            if ($_GET['hargaMin'] != '' || $_GET['hargaMax'] != '') {
              $harga = "AND product_price >= '" . $_GET['hargaMin'] . "' AND product_price <= '" . $_GET['hargaMax'] . "' ";
            }

            if ($_GET['search'] != '' || $_GET['kat'] != '' || $_GET['merk']) {
              $where = "AND product_name LIKE '%" . $_GET['search'] . "%' AND category_id LIKE '%" . $_GET['kat'] . "%' AND merk_id LIKE '%" . $_GET['merk'] . "%' $harga ";
            }

            $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where $harga ORDER BY product_id DESC");
            if (mysqli_num_rows($produk) > 0) {
              while ($p = mysqli_fetch_array($produk)) {
            ?>
                <div id="card" class="card produk-card shadow-sm mx-2 my-3 p-2" style="width: 13rem; border: 0.5px solid rgba(13, 109, 253, 0.543);">
                  <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>" style="color: black;">
                    <img src="produk/<?php echo $p['product_image']; ?>" class="card-img-top p-2" alt="Gambar produk">
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
              <p>Waduh, produk yang kamu cari tidak ada.</p>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php require('components/footer-index.php') ?>

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
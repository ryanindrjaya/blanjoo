<?php
include 'db.php';

session_start();
if ($_SESSION['status_admin_login'] != true) {
  echo '<script>window.location = "login-admin.php"</script>';
}

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
  <title>Data Transaksi | Blanjoo</title>
</head>

<body>
  
  <main class="container-fluid">
    <div class="row">
      <?php require('components/header-dashboard.php') ?>

      <div class="col-md-10 p-4 ">
        <div class="row">
          <div class="col-sm-12">
            <h4>Data Transaksi</h4>
          </div>
          <div class="col-sm-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <td>ID</td>
                  <td>Pembeli</td>
                  <td>Pengiriman</td>
                  <td>Tanggal transaksi</td>
                  <td>Total transaksi</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi JOIN tb_user ON tb_transaksi.id_user=tb_user.user_id JOIN ongkir ON tb_transaksi.id_ongkir=ongkir.id_ongkir ORDER BY id_transaksi DESC");
                if (mysqli_num_rows($transaksi) > 0) {
                  while ($row = mysqli_fetch_array($transaksi)) {
                ?>
                    <tr class="data-produk h-100">
                      <td><?php echo $no++ ?></td>
                      <td><?php echo ucwords($row['user_name']) ?></td>
                      <td><?php echo $row['nama_kota'] ?> - Rp.<?php echo number_format($row['harga_ongkir'])?></td>
                      <td><?php echo $row['tanggal_transaksi'] ?></td>
                      <td>Rp. <?php echo number_format($row['total_transaksi']) ?></td>
                      <td class="text-white d-flex h-100">
                        <button class="btn btn-success mx-1"><a href="detail-transaksi.php?id=<?php echo $row['id_transaksi'] ?>">Detail</a></button>
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
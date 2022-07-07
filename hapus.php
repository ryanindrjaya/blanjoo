<?php
include 'db.php';

if(isset($_GET['idk'])) {
  $hapus_category = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '" . $_GET['idk'] . "'");
  echo '<script>window.location = "data-kategori.php";</script>';
}

if(isset($_GET['idm'])) {
  $dhapus_merk = mysqli_query($conn, "DELETE FROM tb_merk WHERE merk_id = '" . $_GET['idm'] . "' ");
  echo '<script>window.location = "data-merk.php";</script>';
}

if(isset($_GET['idu'])) {
  $dhapus_merk = mysqli_query($conn, "DELETE FROM tb_user WHERE user_id = '" . $_GET['idu'] . "' ");
  echo '<script>window.location = "data-user.php";</script>';
}

if(isset($_GET['idp'])) {
  $produk = mysqli_query($conn, "SELECT product_image From tb_product WHERE product_id = '".$_GET['idp']."' ");
  $p = mysqli_fetch_object($produk);

  unlink('./produk/'.$p->product_image);

  $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '" . $_GET['idp'] . "' ");
  echo '<script>window.location = "data-produk.php";</script>';
}

?>

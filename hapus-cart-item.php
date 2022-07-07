<?php
session_start();

$cart_item = $_GET['id'];
unset($_SESSION['keranjang'][$cart_item]);

echo "<script>alert('Produk berhasil dihapus dari keranjang');</script>";
echo "<script>window.location = 'cart.php'</script>";
?>
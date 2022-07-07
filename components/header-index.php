<!-- HEADER -->
<?php
session_start();

$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '" . $_SESSION['user_id'] . "' ");
$u = mysqli_fetch_object($query);

if ($_SESSION['status_user_login']) {
?>
  <div class="container-fluid bg-light shadow-sm border-bottom h-80 fixed-top py-2">
    <header class="d-flex flex-wrap justify-content-between px-md-4 px-sm-1 ">
      <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span>
          <p class="font-weight-bold fs-2 logo mb-0">Blanjoo!</p>
        </span>
      </a>

      <nav class="nav nav-pills d-flex align-items-center">
        <li class="nav-item"><a href="produk.php" class="nav-link active" aria-current="page">All product</a></li>
        <li class="nav-item"><a href="cart.php" class="nav-link active" aria-current="page">Cart</a></li>
        <li class="nav-item mx-2 login-btn"><a href="login-admin.php" class="btn btn-outline btn-light">Login admin<i style="margin-left: 8px;" class="fa-solid fa-arrow-right-to-bracket"></i></i></a></li>
        <li class="nav-item login-btn"><a href="logout-user.php" class="btn btn-outline btn-light" onclick="return confirm('Apakah anda yakin ingin keluar?')">Logout user<i style="margin-left: 8px;" class="fa-solid fa-arrow-right-from-bracket"></i></i></i></a></li>

        <div style="margin-left: 25px;" class="user-profil d-flex align-items-center fs-6">
          <p class="m-0 mx-2">Halo, <?php echo $u->user_name ?></p>
          <i class="fa-solid fa-circle-user fs-3"></i>
        </div>
    </header>
  </div>
<?php
} else { ?>
  <div class="container-fluid bg-light shadow-sm border-bottom h-80 fixed-top py-2">
    <header class="d-flex flex-wrap justify-content-between px-md-4 px-sm-1 ">
      <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span>
          <p class="font-weight-bold fs-2 logo mb-0">Blanjoo!</p>
        </span>
      </a>

      <nav class="nav nav-pills d-flex align-items-center">
        <li class="nav-item"><a href="produk.php" class="nav-link active" aria-current="page">All product</a></li>
        <li class="nav-item"><a href="cart.php" class="nav-link active" aria-current="page">Cart</a></li>
        <?php
        if ($_SESSION['status_admin_login']) {
        ?>
          <li class="nav-item mx-2 login-btn"><a href="logout-admin.php" class="btn btn-outline btn-light" onclick="return confirm('Apakah anda yakin ingin keluar?')">Logout admin<i style="margin-left: 8px;" class="fa-solid fa-arrow-right-to-bracket"></i></i></a></li>
        <?php
        } else {
        ?>
          <li class="nav-item mx-2 login-btn"><a href="login-admin.php" class="btn btn-outline btn-light">Login admin<i style="margin-left: 8px;" class="fa-solid fa-arrow-right-to-bracket"></i></i></a></li>
        <?php
        }
        ?>
        <li class="nav-item login-btn"><a href="login-user.php" class="btn btn-outline btn-light">Login user<i style="margin-left: 8px;" class="fa-solid fa-arrow-right-to-bracket"></i></i></a></li>
        </ul>
    </header>
  </div>
<?php
}
?>
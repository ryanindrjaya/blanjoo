<!-- KATEGORI MOBILE -->
<div class="navbar navbar-expand-lg navbar-light bg-light d-block d-sm-block d-md-none">
  <div class="container-fluid">
    <h6 class="navbar-brand" href="#">Kategori</h6>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <?php
        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
        if (mysqli_num_rows($kategori) > 0) {
          while ($k = mysqli_fetch_array($kategori)) {
        ?>
            <li class="nav-item">
              <a href="produk.php?kat=<?php echo $k['category_id']; ?> " style="color: black;">
                <p class="mt-2"><?php echo $k['category_name']; ?></p>
              </a>
            </li>
          <?php }
        } else { ?>
          <p>Kategori tidak ada</p>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>

<!-- KATEGORI -->
<div class="container my-2">
  <div class="kategori-menu row d-none d-sm-none d-md-flex justify-content-evenly">
    <h3 class="mt-3 text-center display-4">Kategori</h3>
    <?php
    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
    if (mysqli_num_rows($kategori) > 0) {
      while ($k = mysqli_fetch_array($kategori)) {
    ?>
        <a class="col-md-2 mt-2 p-1 d-flex flex-column p justify-content-center align-items-center text-center ikon rounded-2" href="produk.php?kat=<?php echo $k['category_id']; ?> " style="color: black; height: 10em;">
          <img src="icon/<?php echo $k['category_image'] ?>" class="p-3" alt="" style="width: 6rem;">
          <p class="fs-3 text-white"><?php echo $k['category_name'] ?></p>
        </a>
      <?php }
    } else { ?>
      <p>Kategori tidak ada</p>
    <?php } ?>
  </div>
</div>
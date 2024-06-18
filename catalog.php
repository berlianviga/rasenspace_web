<?php
require "koneksi.php";
session_start();

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

//get product by nama produk/keyword
if (isset($_GET['keyword'])) {
  $keyword = mysqli_real_escape_string($con, $_GET['keyword']);

  // Query untuk mendapatkan produk berdasarkan nama_produk
  $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'");
  $countData = mysqli_num_rows($queryProduk);
}

//get product by kategori
else if (isset($_GET['category'])) {
  // Escape input untuk menghindari SQL Injection
  $kategori = mysqli_real_escape_string($con, $_GET['category']);

  // Query untuk mendapatkan id_kategori
  $queryGetKategoriId = mysqli_query($con, "SELECT id_kategori FROM kategori WHERE nama_kategori='$kategori'");

  // Periksa apakah query berhasil
  if (!$queryGetKategoriId) {
    die('Query Error (Get Kategori ID): ' . mysqli_error($con));
  }

  // Ambil hasil query
  $kategoriId = mysqli_fetch_array($queryGetKategoriId);

  // Periksa apakah kategori ditemukan
  if ($kategoriId) {
    // Query untuk mendapatkan produk berdasarkan id_kategori
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE id_kategori='$kategoriId[id_kategori]'");

    // Periksa apakah query berhasil
    if (!$queryProduk) {
      die('Query Error (Produk by Kategori): ' . mysqli_error($con));
    }
  } else {
    die('Kategori tidak ditemukan.');
  }
}
//get product default
else {
  $queryProduk = mysqli_query($con, "SELECT * FROM produk");
}

$countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catalog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #FBBEDF;
    }

    .btn-signin {
      background-color: #acf3fb;
      transition: 0.3s background-color;
      font-weight: 600;
    }

    .btn-signin:hover {
      background-color: #9ee1e9;
    }

    .btn-outline-signup {
      border-color: grey;
    }

    .btn-outline-signup:hover {
      background-color: #fcd7eb;
    }

    .navbar-toggler {
      border: none;
    }

    .navbar-brand {
      font-weight: 600;
    }

    .navbar {
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      background-color: rgba(251, 190, 223, 0.651);
    }

    #banner-catalog {
      margin-top: 8%;
    }

    #banner-catalog-content-category {
      font-family: "Playfair Display", serif;
    }

    #banner-catalog-content-title {
      font-weight: 600;
    }

    .list-group a {
      text-decoration: none;
    }

    .btn-search {
      background-color: #FF71B2;
    }

    .icons .fab,
    .icons .fas {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      text-align: center;
      line-height: 40px;
      font-size: 20px;
      background-color: black;
    }

    footer {
      border-top-left-radius: 125px;
    }

    @media screen and (max-width: 768px) {
      #banner-catalog {
        display: none;
      }

      .search-product {
        margin-top: 20%;
      }

      footer {
        border-top-right-radius: 125px;
      }
    }

    <?php if (isset($_SESSION['login']) && $_SESSION['login']) : ?><style>.btn-signin,
    .btn-outline-signup {
      display: none;
      /* Menyembunyikan tombol sign in dan sign up jika pengguna sudah masuk */
    }
  </style>
<?php endif; ?>
</style>
</head>

<body>
  <!--Navbar-->
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Rasen Space</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item me-5">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link " href="about.php">About</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link active" href="catalog.php">Catalog</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link" href="<?php echo (isset($_SESSION['login']) && $_SESSION['login']) ? 'contact.php' : 'signIn.php'; ?>">Contact</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link" href="guide.php">Guide</a>
            </li>

          </ul>
          <?php if (!isset($_SESSION['login']) || !$_SESSION['login']) : ?>
            <form class="d-flex">
              <button class="btn btn-signin me-2" type="submit">
                <a href="signIn.php" style="text-decoration: none; color: black;">Sign In</a>
              </button>
              <button class="btn btn-outline-signup" type="submit">
                <a href="signUp.php" style="text-decoration: none; color: black;">Sign Up</a>
              </button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </nav>
  </div>
  <!--End of Navbar-->

  <!--Banner Catalog-->
  <div id="banner-catalog" class="container-fluid bg-light">
    <div id="banner-catalog-content" class="container">
      <h2 id="banner-catalog-content-title" class="text-center pt-5 pb-5"><span style="color: #FBBEDF;;">Catalog</span> Product </h2>
      <div class="row d-flex justify-content-center">
        <div id="banner-catalog-content-category-1" class="col-lg-2">
          <img src="assets/ring.png" alt="ring-pic" class="img-fluid mb-3">
          <div class="p-1 text-center" style="background-color: #acf3fb;">
            <h4 id="banner-catalog-content-category">Ring</h4>
          </div>
        </div>
        <div id="banner-catalog-content-category-1" class="col-lg-2">
          <img src="assets/bracelet.png" alt="bracelet-pic" class="img-fluid mb-3">
          <div class="p-1 text-center" style="background-color: #acf3fb;">
            <h4 id="banner-catalog-content-category">Bracelet</h4>
          </div>
        </div>
        <div id="banner-catalog-content-category-1" class="col-lg-2">
          <img src="assets/keychain.png" alt="keychain-pic" class="img-fluid mb-3">
          <div class="p-1 text-center" style="background-color: #acf3fb;">
            <h4 id="banner-catalog-content-category">Keychain</h4>
          </div>
        </div>
        <div id="banner-catalog-content-category-1" class="col-lg-2">
          <img src="assets/totebag.png" alt="totebag-pic" class="img-fluid mb-3">
          <div class="p-1 text-center" style="background-color: #acf3fb;">
            <h4 id="banner-catalog-content-category">Totebag</h4>
          </div>
        </div>
        <div id="banner-catalog-content-category-1" class="col-lg-2">
          <img src="assets/slingbag.png" alt="slingbag-pic" class="img-fluid mb-3">
          <div class="p-1 mb-5 text-center" style="background-color: #acf3fb;">
            <h4 id="banner-catalog-content-category">Slingbag</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--End of Banner Catalog-->

  <!--Catalog Product-->
  <div class="container-fluid">
    <div class="container search-product">
      <h3 class="text-center mt-5">All Product</h3>
      <div class="col-md-8 offset-2">
        <form method="get" action="">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nama Produk" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
            <button type="submit" class="btn btn-search">Search</button>
          </div>
        </form>
      </div>
    </div>
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-3 mb-5">
          <h3>Category</h3>
          <ul class="list-group">
            <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
              <a href="catalog.php?category=<?php echo $kategori['nama_kategori'] ?>">
                <li class="list-group-item"><?php echo $kategori['nama_kategori'] ?></li>
              </a>
            <?php } ?>
          </ul>
        </div>
        <div class="col-lg-9 mt-5">
          <div class="row">
            <?php
            if ($countData < 1) {
            ?>
              <h4 class="text-center">Produk yang dicari tidak tersedia</h4>
            <?php
            }
            ?>
            <?php
            while ($produk = mysqli_fetch_array($queryProduk)) {
            ?>
              <div class="col-md-4 mb-4">
                <div class="card h-100">
                  <div class="image-box">
                    <img src="image/<?php echo $produk['foto'] ?>" class="card-img-top p-2" alt="">
                  </div>
                  <div class="card-body">
                    <h5>
                      <i class="fa-solid fa-star" style="color: #FFD43B;"></i> <?php echo $produk['rating'] ?>
                    </h5>
                    <h5 class="card-title"><?php echo $produk['nama_produk'] ?></h5>
                    <p class="card-text">IDR <?php echo $produk['harga'] ?></p>
                    <a href="produk_detail.php?nama=<?php echo $produk['nama_produk'] ?>" class="btn btn-primary">Detail</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--End of Catalog Product-->

  <!--Footer-->
  <footer class="pt-2 pb-1" style="background-color: #FCA3CC">
    <div class="container">
      <div class="row text-md-left">
        <div class="com-md-3 col-lg-4 col-xl-4 mx-auto mt-3">
          <h5 class="mb-4 font-weight-bold ">Rasen Space</h5>
          <div class="icons">
            <a href="https://www.instagram.com/rasen.space?igsh=MWZmZm14YjVqZWF1ag=="><i class="fab fa-instagram" style="color: white"></i></a>
            <a href="https://api.whatsapp.com/send/?phone=6289505517890&amp;text=Halo"><i class="fab fa-whatsapp" style="color: white"></i></a>
            <a href="https://id.shp.ee/FoStz6y"><i class="fab fa-shopify" style="color: white"></i></a>
          </div>
        </div>
        <div class="col-md-3 col-lg-4 col-xl-4 mx-auto mt-3">
          <h5 class="mb-4 font-weight-bold">Company</h5>
          <p>
            <a href="index.pho" class="text-dark" style="text-decoration: none;">Home</a>
          </p>
          <p>
            <a href="about.php" class="text-dark" style="text-decoration: none;">About</a>
          </p>
          <p>
            <a href="catalog.php" class="text-dark" style="text-decoration: none;">Catalog</a>
          </p>
          <p>
            <a href="contact.php" class="text-dark" style="text-decoration: none;">Contact</a>
          </p>
          <p>
            <a href="guide.php" class="text-dark" style="text-decoration: none;">Guide</a>
          </p>
        </div>
        <div class="col-md-3 col-lg-4 col-xl-4 mx-auto mt-3">
          <h5 class="font-weight-bold">Contact</h5>
          <a href="mailto:herasenbusiness@gmail.com" style="text-decoration: none; color: black;"><i class="fas fa-envelope"></i> herasenbusiness@gmail.com</a>
        </div>
      </div>
      <hr>
      <p class="text-center mt-1" style="font-size: 13px;">Rasen Space © Copyright 2024 - All Rights Reserved</p>
    </div>
  </footer>
  <!--End of Footer-->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
</body>

</html>
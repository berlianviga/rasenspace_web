<?php
require "koneksi.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Poppins", sans-serif;
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

    .about-info {
      margin-top: 10%;
    }

    .about-pic {
      margin-top: 80px;
      padding-bottom: 30px;
    }

    .img-about {
      width: 500px;
    }

    .navbar-brand {
      font-weight: 600;
    }

    .navbar {
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      background-color: rgba(251, 190, 223, 0.651);
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

    @media screen and (max-width: 768px) {
      .about-info {
        padding-bottom: 50px;
        padding-left: 20px;
      }

      footer {
        border-top-right-radius: 125px;
      }
    }

    @media screen and (min-width: 1300px) {
      .about-info {
        padding-left: 50px;
      }

      footer {
        border-top-left-radius: 125px;
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
              <a class="nav-link active" href="about.php">About</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link " href="catalog.php">Catalog</a>
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
  <div class="container-fluid" style="background-color: #FBBEDF;">
    <div class="row">
      <div class="about-info col-12 col-md-6">
        <h2 class="title-about fw-bold" style="margin-top: 15%">
          About us
        </h2>
        <p>
          Rasen Space is an MSME engaged in handicrafts that produces and sells a variety of creative products. Each product at Rasen Space is made with high craftsmanship and attention to detail, reflecting local wisdom as well as modern aesthetics.
        </p>
      </div>
      <div class="about-pic col col-12 col-md-6 d-none d-md-flex d-flex justify-content-center align-items-center">
        <img class="img-about " src="assets/about.png" alt="" />
      </div>
    </div>
  </div>

  <!--Our Product-->
  <div class="container-fluid mt-5" style="background-color: white">
    <h2 class="text-center pt-5 mb-4" style="font-weight: 600">
      Our Product
    </h2>
    <div id="carouselExampleCaptions" class="carousel slide col-lg-6 offset-lg-3" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/fashion.png" class="d-block w-100" alt="fashion" />
          <div class="carousel-caption d-none d-md-block">
            <h5>Fashion</h5>
            <p>
              Discover fashion accessories that not only complement your appearance but also reveal your unique personality and style.. 
            </p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/beads.png" class="d-block w-100" alt="beads accessories" />
          <div class="carousel-caption d-none d-md-block">
            <h5>Beads Accessories</h5>
            <p>
              Explore our collection and find beads accessories that resonate with your unique taste and enhance your fashion statement. 
            </p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <!--End of Our Product-->

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
<?php
session_start();
require "koneksi.php";

$nama = $_GET['nama'];
$queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama_produk='$nama'");
$produk = mysqli_fetch_array($queryProduk);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Product</title>
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

        .btn-signin,
        .btn-search {
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

        .btn-order {
            background-color: #FCA3CC;
            transition: 0.3s background-color;
        }

        .btn-order:hover {
            background-color: #FF71B2;
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
                <a class="navbar-brand fs-2" href="#">Rasen Space</a>
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
                            <a class="nav-link" href="contact.php">Contact</a>
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
                                <a href="signUp.php" style="text-decoration: none; color: black;">
                                    Sign Up
                                </a>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>
    <!--End of Navbar-->

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-5 mb-1">
                    <img src="image/<?php echo $produk['foto'] ?>" class="w-100" alt="">
                </div>
                <div class="col-md-6 offset-md-1">
                    <h1><?php echo $produk['nama_produk'] ?></h1>
                    <p>
                        <?php echo $produk['detail'] ?>
                    </p>
                    <p>Stok : <?php echo $produk['stok'] ?> </p>
                    <p class="fs-3">IDR <?php echo $produk['harga'] ?></p>

                    <a href="https://api.whatsapp.com/send/?phone=6289505517890&amp;text=Halo" class='btn btn-order mt-1 col-lg-4 col-md-12' style="text-decoration: none">
                        <i class="fa-brands fa-whatsapp"></i> Order by WA
                    </a>
                </div>
            </div>
            <div class="col-md-5">
            </div>
        </div>

        <!--End of Catalog Product-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>
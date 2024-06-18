<?php
session_start();
require "koneksi.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
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

    .btn-submit {
      background-color: #acf3fb;
    }

    .btn-submit:hover {
      background-color: #9ee1e9;
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
      footer {
        border-top-right-radius: 125px;
      }
    }

    @media screen and (min-width: 1300px) {
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
              <a class="nav-link " href="catalog.php">Catalog</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link active" href="<?php echo (isset($_SESSION['login']) && $_SESSION['login']) ? 'contact.php' : 'signIn.php'; ?>">Contact</a>
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
  <!--Contact Us Content-->
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 110vh;">
    <div class="row ">
      <div id="contact-information" class="col-lg-6 col-md-12 p-3">
        <h3>Get In Touch With Us</h3>
        Give us your incredible support through email by fill this form.
        <div class="icons mt-3">
          <a href="https://api.whatsapp.com/send/?phone=6289505517890&amp;text=Halo" style="text-decoration: none; color: black;"><i class="fab fa-whatsapp" style="color: white;"></i> +62 895 0551 7890</a>
        </div>
        <div class="icons mt-3">
          <a href="mailto:herasenbusiness@gmail.com" style="text-decoration: none; color: black;"><i class="fas fa-envelope" style="color: white;"></i> @herasenbusiness@gmail.com</a>
        </div>
      </div>
      <div id="contact-form" class="col-lg-6 col-md-12">
        <div class="card p-5 ">
          <form action="" method="post">
            <div class="mb-3">
              <input type="email" class="form-control" name="email_pengirim" id="email_pengirim" placeholder="Your Email" required>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="nama" id="nama" placeholder="Your Name" required>
            </div>
            <div class="mb-3">
              <textarea id="body_message" name="body_message" class="form-control" cols="30" rows="10"></textarea>
            </div>
            <div>
              <button class="btn btn-submit w-100" type="submit" name="submit">Send Message</button>
            </div>
          </form>

          <?php
          if (isset($_POST['submit'])) {
            // Ambil data dari formulir
            $email_pengirim = $_POST['email_pengirim'];
            $subject = $_POST['subject'];
            $nama = $_POST['nama'];
            $body_message = $_POST['body_message'];

            // Query untuk menyimpan data ke database
            $query = "INSERT INTO contact_message (email_pengirim, subject, nama, body_message) 
          VALUES ('$email_pengirim', '$subject', '$nama', '$body_message')";

            // Eksekusi query
            $result = mysqli_query($con, $query);

            if ($result) {
          ?>
              <div class="alert alert-primary mt-3" role="alert">
                Pesan terkirim
              </div>
            <?php

            } else {
            ?>
              <div class="alert alert-warning mt-3" role="alert">
                Pesan gagal terkirim
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <!--End Contact Us-->

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

  <!--script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
</body>

</html>
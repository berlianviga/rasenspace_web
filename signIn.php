<?php
session_start();
require "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #FBBEDF;
    }

    .btn-signin {
      background-color: #acf3fb;
    }

    .btn-signin:hover {
      background-color: #9ee1e9;
    }

    .btn-outline-signup {
      border-color: grey;
    }

    .btn-outline-signup:hover {
      border-color: #9ee1e9;
      color: #9ee1e9;
    }
  </style>
</head>

<body>
  <div class="container-fluid d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card col-lg-4 p-5 ">
      <form id="authForm" action="" method="post" autocomplete="off">
        <h2 class="text-center"> Sign In</h2>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
        </div>
        <div class="mb-3">
          <button class="btn btn-signin w-100" type="submit" name="signInbtn">Sign In</button>
        </div>
        <div class="mb-3">
          <button class="btn btn-outline-signup w-100" type="button" onclick="window.location.href='signUp.php'">Sign Up</button>
        </div>
      </form>
    </div>
    <div class="mt-3">
      <?php
      if (isset($_POST['signInbtn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
        $countdata = mysqli_num_rows($query);
        $data = mysqli_fetch_array($query);
        if ($countdata > 0) {
          // Verifikasi password
          if ($password === $data['password']) { // Periksa apakah password sesuai
            $_SESSION['username'] = $data['username'];
            $_SESSION['login'] = true;

            // Periksa peran pengguna dan arahkan sesuai
            if ($data['role'] == 0) {
              header('location: index.php'); // Redirect ke halaman utama
              exit;
            } else if ($data['role'] == 1) {
              header('location: adminpanel/index.php'); // Redirect ke dasbor
              exit;
            }
          } else {
            echo '<div class="alert alert-warning" role="alert">Password salah</div>';
          }
        } else {
          echo '<div class="alert alert-warning" role="alert">Akun tidak tersedia</div>';
        }
      }

      ?>
    </div>
  </div>
</body>

</html>
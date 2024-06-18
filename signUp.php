<?php
session_start();
require "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #FBBEDF;
        }

        .btn-signup {
            background-color: #acf3fb;
        }

        .btn-signup:hover {
            background-color: #9ee1e9;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row">
            <div id="signup-info" class="col-md-12 col-lg-6 mb-5">
                <div class="card p-5 ">
                    <h3>Benefits if you log in</h3>
                    <ul>
                        <li>Special offers and exclusive discounts only for members.</li>
                        <li>Access to special offers and exclusive rewards through our loyalty program.</li>
                    </ul>
                </div>
            </div>
            <div id="signup-form" class="col-md-12 col-lg-6">
                <div class="card p-5 ">
                    <form action="signUp.php" method="post">
                        <h2 class="text-center"> Sign Up</h2>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-5">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-signup w-100" type="submit" name="submit">Sign Up</button>
                        </div>

                        <div>
                            <?php
                            if (isset($_POST['submit'])) {
                                $username = $_POST['username'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];

                                // Periksa apakah username sudah ada
                                $query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
                                $countdata = mysqli_num_rows($query);
                                $data = mysqli_fetch_array($query);

                                if (!$query) {
                                    die("Query error: " . mysqli_error($koneksi));
                                }

                                if ($countdata > 0) {
                                    echo '<div class="alert alert-warning" role="alert">Username sudah ada, silahkan buat username lain</div>';
                                } else {
                                    // Tambahkan pengguna baru
                                    if (mysqli_query($con, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')")) {
                                        $_SESSION['login'] = true;
                                        header('Location: index.php');
                                        exit();
                                    } else {
                                        echo "Error: " . $query . "<br>" . mysqli_error($con);
                                    }
                                }
                            }

                            ?>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
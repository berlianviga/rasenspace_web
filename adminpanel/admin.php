<?php
require "koneksi.php";
session_start();

$queryAdmin = mysqli_query($con, "SELECT * FROM users WHERE role = 1");
$jumlahAdmin = mysqli_num_rows($queryAdmin);

// Tangani aksi delete
if (isset($_POST['deleteBtn'])) {
    $id_user = $_POST['id_user'];
    $deleteQuery = "DELETE FROM users WHERE id_user = '$id_user'";
    mysqli_query($con, $deleteQuery);
    header("Location: admin.php");
}

$username = "";
$email = "";
$password = "";
$role = "";
$id_user = "";

if (isset($_POST['editBtn'])) {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div>

        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="bag-handle"></ion-icon>
                        </span>
                        <span class="title">RasenSpace</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="customer.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>

                <li>
                    <a href="admin.php">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Admin</span>
                    </a>
                </li>

                <li>
                    <a href="produk.php">
                        <span class="icon">
                            <ion-icon name="basket-outline"></ion-icon>
                        </span>
                        <span class="title">Product</span>
                    </a>
                </li>

                <li>
                    <a href="kategori.php">
                        <span class="icon">
                            <ion-icon name="basket-outline"></ion-icon>
                        </span>
                        <span class="title">Category</span>
                    </a>
                </li>

                <li>
                    <a href="message.php">
                        <span class="icon">
                            <ion-icon name="chatbox-outline"></ion-icon>
                        </span>
                        <span class="title">Message</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="main">

            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div>
                    <h1>Dashboard</h1>
                </div>

            </div>

            <div class="m-5 col-12 col-md-6">
                <h3>Tambah Admin</h3>
                <form action="" method="post">
                    <div>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?php echo $username; ?>" />
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>" />
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="text" id="password" name="password" class="form-control" value="<?php echo $password; ?>" />
                    </div>
                    <div>
                        <label for="role">Role</label>
                        <input type="text" id="role" name="role" placeholder="Isi dengan angka '1'" class="form-control" value="<?php echo $role; ?>" />
                    </div>
                    <div class="mt-3">
                        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
                        <button class="btn btn-primary" type="submit" name="<?php echo $id_user ? 'update_admin' : 'simpan_admin'; ?>"><?php echo $id_user ? 'Update' : 'Simpan'; ?></button>
                    </div>
                </form>
                <?php
                if (isset($_POST['simpan_admin'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $role = $_POST['role'];

                    $queryExist = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
                    $jumlahDataAdminBaru = mysqli_num_rows($queryExist);

                    if ($jumlahDataAdminBaru > 0) {
                ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Username admin sudah ada
                        </div>
                        <?php
                    } else {
                        $querySimpan = mysqli_query($con, "INSERT INTO users (username, email, password, role ) VALUES ('$username', '$email', '$password' , '$role')");

                        if ($querySimpan) {
                        ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Admin berhasil tersimpan
                            </div>

                            <meta http-equiv="refresh" content="2; url=admin.php" />

                        <?php
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                }

                if (isset($_POST['update_admin'])) {
                    $id_user = $_POST['id_user'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $role = $_POST['role'];

                    $updateQuery = "UPDATE users SET username='$username', email='$email', password='$password', role='$role' WHERE id_user=$id_user";
                    $result = mysqli_query($con, $updateQuery);

                    if ($result) {
                        ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Admin berhasil diupdate
                        </div>
                        <meta http-equiv="refresh" content="2; url=admin.php" />
                <?php
                    } else {
                        echo mysqli_error($con);
                    }
                }
                ?>
            </div>

            <h2 class="m-5">Daftar Admin</h2>

            <div class="table-responsive m-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahAdmin == 0) {
                            echo "<tr><td colspan='6' class='text-center'>Data Admin Tidak Tersedia</td></tr>";
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryAdmin)) {
                                echo "<tr>
                                    <td>{$jumlah}</td>
                                    <td>{$data['username']}</td>
                                    <td>{$data['email']}</td>
                                    <td>{$data['password']}</td>
                                    <td>{$data['role']}</td>
                                    <td>
                                        <form action='' method='post' style='display:inline-block;'>
                                            <input type='hidden' name='id_user' value='{$data['id_user']}' />
                                            <button type='submit' class='btn btn-danger' name='deleteBtn'>Delete</button>
                                        </form>
                                        <form action='' method='post' style='display:inline-block;'>
                                            <input type='hidden' name='id_user' value='{$data['id_user']}' />
                                            <input type='hidden' name='username' value='{$data['username']}' />
                                            <input type='hidden' name='email' value='{$data['email']}' />
                                            <input type='hidden' name='password' value='{$data['password']}' />
                                            <input type='hidden' name='role' value='{$data['role']}' />
                                            <button type='submit' class='btn btn-success' name='editBtn'>Edit</button>
                                        </form>
                                    </td>
                                </tr>";
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
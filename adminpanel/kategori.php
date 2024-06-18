<?php
require "koneksi.php";
session_start();

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
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
                <h3>Tambah Kategori</h3>
                <form action="" method="post">
                    <div>
                        <label for="kategori">Kategori</label>
                        <input type="text" id="kategori" name="nama_kategori" placeholder="input nama kategori" class="form-control" />
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['simpan_kategori'])) {
                    $kategori = $_POST['nama_kategori'];

                    $queryExist = mysqli_query($con, "SELECT nama_kategori FROM kategori WHERE nama_kategori='$kategori'");
                    $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                    if ($jumlahDataKategoriBaru > 0) {
                ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori sudah ada
                        </div>
                        <?php
                    } else {
                        $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama_kategori) VALUES ('$kategori')");

                        if ($querySimpan) {
                        ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori berhasil tersimpan
                            </div>

                            <meta http-equiv="refresh" content="2; url=kategori.php" />

                <?php
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                }
                ?>
            </div>

            <h2 class="m-5">Daftar Kategori</h2>

            <div class="table-responsive m-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahKategori == 0) {
                        ?>
                            <tr>
                                <td colspan=3 class="text-center">Data kategori tidak tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryKategori)) {
                            ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama_kategori']; ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori']; ?>" />
                                            <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <?php
            if (isset($_POST['deleteBtn'])) {
                $id_kategori = $_POST['id_kategori'];
                $queryDelete = mysqli_query($con, "DELETE FROM kategori WHERE id_kategori='$id_kategori'");
                if ($queryDelete) {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Kategori berhasil dihapus
                    </div>

                    <meta http-equiv="refresh" content="2; url=kategori.php" />
            <?php
                } else {
                    echo mysqli_error($con);
                }
            }
            ?>
        </div>
    </div>


    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
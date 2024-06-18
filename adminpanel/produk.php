<?php
require "koneksi.php";
session_start();

$queryProduk = mysqli_query($con, "SELECT a.*, b.nama_kategori AS nama_kategori FROM produk a JOIN kategori b ON  a.id_kategori=b.id_kategori");
$jumlahProduk = mysqli_num_rows($queryProduk);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopgrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
};

//Delete
if (isset($_POST['deleteBtn'])) {
    $id_produk = $_POST['id_produk'];
    $deleteQuery = "DELETE FROM produk WHERE id_produk = '$id_produk'";
    mysqli_query($con, $deleteQuery);
    header("Location: produk.php");
}

// Tangani aksi update
if (isset($_POST['updateBtn'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $detail = $_POST['detail'];
    $stok = $_POST['stok'];
    $rating = $_POST['rating'];

    $updateQuery = "UPDATE produk SET nama_produk='$nama_produk', id_kategori='$kategori', harga='$harga', detail='$detail', stok='$stok', rating='$rating' WHERE id_produk='$id_produk'";
    mysqli_query($con, $updateQuery);
    header("Location: produk.php");
}

$nama_produk = "";
$kategori = "";
$harga = "";
$detail = "";
$stok = "";
$rating = "";
$id_produk = "";

if (isset($_POST['editBtn'])) {
    $id_produk = $_POST['id_produk'];
    $queryEdit = mysqli_query($con, "SELECT * FROM produk WHERE id_produk='$id_produk'");
    $dataEdit = mysqli_fetch_array($queryEdit);

    $nama_produk = $dataEdit['nama_produk'];
    $kategori = $dataEdit['id_kategori'];
    $harga = $dataEdit['harga'];
    $detail = $dataEdit['detail'];
    $stok = $dataEdit['stok'];
    $rating = $dataEdit['rating'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
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
                <h3>Tambah Poduk</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk" class="form-control mb-1" value="<?php echo $nama_produk; ?>">
                    </div>
                    <div>
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control mb-1">
                            <option value="">Pilih satu</option>
                            <?php
                            $queryKategori = mysqli_query($con, "SELECT * FROM kategori"); // Re-fetch the categories
                            while ($data = mysqli_fetch_array($queryKategori)) {
                                $selected = ($data['id_kategori'] == $kategori) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $data['id_kategori']; ?>" <?php echo $selected; ?>><?php echo $data['nama_kategori']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control mb-1" name="harga" value="<?php echo $harga; ?>">
                    </div>
                    <div>
                        <label for="foto">Foto</label>
                        <?php if ($id_produk && !empty($dataEdit['foto'])) : ?>
                            <img src="../image/<?php echo $dataEdit['foto']; ?>" alt="Foto Produk" style="width:100px; height:auto;">
                        <?php endif; ?>
                        <input type="file" name="foto" id="foto" class="form-control mb-1">
                    </div>
                    <div>
                        <label for="detail">Detail Produk</label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo $detail; ?></textarea>
                    </div>
                    <div>
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control mb-1" name="stok" value="<?php echo $stok; ?>">
                    </div>
                    <div>
                        <label for="rating">Rating</label>
                        <input type="text" class="form-control mb-1" name="rating" value="<?php echo $rating; ?>">
                    </div>
                    <div>
                        <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" />
                        <button class="btn btn-primary" type="submit" name="<?php echo $id_produk ? 'update_produk' : 'simpan_produk'; ?>"><?php echo $id_produk ? 'Update' : 'Simpan'; ?></button>
                    </div>
                </form>

                <?php
                if (isset($_POST['simpan_produk'])) {
                    $nama_produk = $_POST['nama_produk'];
                    $kategori = $_POST['kategori'];
                    $harga = $_POST['harga'];
                    $detail = $_POST['detail'];
                    $stok = $_POST['stok'];
                    $rating = $_POST['rating'];

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if ($nama_produk == '' || $kategori == '' || $harga == '') {
                ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama, kategori, dan harga wajib diisi
                        </div>
                        <?php
                    } else {
                        if ($nama_file != '') {
                            if ($image_size > 500000) {
                        ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File tidak boleh lebih dari 500 Kb
                                </div>
                                <?php
                            } else {
                                if ($imageFileType != 'jpg' && $imageFileType != 'png') {
                                ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        File wajib bertipe jpg atau png
                                    </div>
                            <?php
                                } else {
                                    move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $new_name);
                                }
                            }
                        }

                        //query insert to produk table
                        $queryTambah = mysqli_query($con, "INSERT INTO produk (id_kategori, nama_produk, harga, foto, detail, stok, rating) VALUES ('$kategori', '$nama_produk', '$harga', '$new_name', '$detail', '$stok', '$rating')");

                        if ($queryTambah) {
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Produk berhasil disimpan
                            </div>

                            <meta http-equiv="refresh" content="2; url=produk.php" />
                <?php
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                }
                if (isset($_POST['update_produk'])) {
                    $id_produk = $_POST['id_produk'];
                    $nama_produk = $_POST['nama_produk'];
                    $kategori = $_POST['kategori'];
                    $harga = $_POST['harga'];
                    $detail = $_POST['detail'];
                    $stok = $_POST['stok'];
                    $rating = $_POST['rating'];

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    $foto_query_part = "";

                    // Jika ada file gambar baru yang diupload, tambahkan ke query
                    if ($nama_file != '') {
                        if ($image_size > 500000) {
                            echo "<div class='alert alert-warning mt-3' role='alert'>File tidak boleh lebih dari 500 Kb</div>";
                        } else if ($imageFileType != 'jpg' && $imageFileType != 'png') {
                            echo "<div class='alert alert-warning mt-3' role='alert'>File wajib bertipe jpg atau png</div>";
                        } else {
                            move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $new_name);
                            $foto_query_part = ", foto='$new_name'";
                        }
                    }

                    $updateQuery = "UPDATE produk SET nama_produk='$nama_produk', id_kategori='$kategori', harga='$harga', detail='$detail', stok='$stok', rating='$rating' $foto_query_part WHERE id_produk='$id_produk'";

                    $result = mysqli_query($con, $updateQuery);

                    if ($result) {
                        echo "<div class='alert alert-primary mt-3' role='alert'>Produk berhasil diupdate</div>";
                        echo "<meta http-equiv='refresh' content='2; url=produk.php' />";
                    } else {
                        echo "<div class='alert alert-danger mt-3' role='alert'>Terjadi kesalahan: " . mysqli_error($con) . "</div>";
                    }
                }

                ?>
            </div>

            <h2 class="m-5">Daftar Produk</h2>

            <div class="table-responsive m-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahProduk == 0) {
                        ?>
                            <tr>
                                <td colspan=5 class="text-center">Data Produk tidak tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryProduk)) {
                            ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama_produk']; ?></td>
                                    <td><?php echo $data['nama_kategori']; ?></td>
                                    <td><?php echo $data['harga']; ?></td>
                                    <td><?php echo $data['stok']; ?></td>
                                    <td><?php echo $data['rating']; ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_produk" value="<?php echo $data['id_produk']; ?>" />
                                            <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                                        </form>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_produk" value="<?php echo $data['id_produk']; ?>" />
                                            <button type="submit" class="btn btn-success" name="editBtn">Edit</button>
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
        </div>
    </div>


    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
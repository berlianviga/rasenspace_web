<?php
require "koneksi.php";
session_start();

$queryUsers = mysqli_query($con, "SELECT * FROM users WHERE role=0");
$jumlahUsers = mysqli_num_rows($queryUsers);

$queryProduk = mysqli_query($con, "SELECT * FROM produk ");
$jumlahProduk = mysqli_num_rows($queryProduk);

// Query untuk mengambil jumlah produk berdasarkan kategori dengan join
$queryKategori = mysqli_query($con, "
    SELECT kategori.nama_kategori, COUNT(produk.id_produk) as total_produk 
    FROM produk
    JOIN kategori ON produk.id_kategori = kategori.id_kategori 
    GROUP BY kategori.nama_kategori
");

$categories = [];
while ($row = mysqli_fetch_assoc($queryKategori)) {
    $categories[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- =============== Navigation ================ -->
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

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div>
                    <h1>Dashboard</h1>
                </div>

            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $jumlahProduk; ?></div>
                        <div class="cardName">Jumlah Produk</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="basket-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $jumlahUsers; ?></div>
                        <div class="cardName">Pengguna Website</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>
            </div>
            <h2 class="m-3">Barchart Jumlah Produk Berdasarkan Kategori</h2>
            <!-- ======================= Chart ================== -->
            <div class="card m-3">
                <div class="chartContainer" style="width: 70%; margin: auto;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        // Ambil data dari PHP dan parse menjadi array JavaScript
        var categories = <?php echo json_encode($categories); ?>;

        var categoryNames = categories.map(kategori => kategori.nama_kategori);
        var categoryCounts = categories.map(kategori => kategori.total_produk);

        var ctx = document.getElementById('categoryChart').getContext('2d');
        var categoryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categoryNames,
                datasets: [{
                    label: 'Jumlah Produk per Kategori',
                    data: categoryCounts,
                    backgroundColor: '#2a2185',
                    borderColor: '#2a2185',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
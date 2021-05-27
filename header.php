<?php 
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
</head>
<body>
    <div class="header">
        <a href="index.php" class="page-link">Kujang Rent Car</a>
        <span>></span>
        <?php 

            if (isset($_GET['page'])) {
                // routeLink($url, $text);
                if ($_GET['page'] == "cars") {
                    echo routeLink('index.php?page=cars', 'Mobil');
                } elseif ($_GET['page'] == "car_add") {
                    echo routeLink('index.php?page=cars', 'Mobil'); 
                    echo '<span>></span>';
                    echo routeLink('', 'Tambah Mobil');
                } elseif ($_GET['page'] == "car_edit") {
                    echo routeLink('index.php?page=cars', 'Mobil'); 
                    echo '<span>></span>';
                    echo routeLink('', 'Ubah Mobil');
                } elseif ($_GET['page'] == "car_detail") {
                    echo routeLink('index.php?page=cars', 'Mobil'); 
                    echo '<span>></span>';
                    echo routeLink('', 'Detail Mobil');
                } elseif ($_GET['page'] == "bookings") {
                    echo routeLink('', 'Pemesanan');
                } elseif ($_GET['page'] == "booking_detail") {
                    echo routeLink('index.php?page=bookings', 'Pemesanan');
                    echo '<span>></span>';
                    echo routeLink('', 'Rincian Pesanan');
                } elseif ($_GET['page'] == "ongoing") {
                    echo routeLink('', 'Proses Peminjaman');
                } elseif ($_GET['page'] == "ongoing_detail") {
                    echo routeLink('index.php?page=ongoing', 'Proses Peminjaman');
                    echo '<span>></span>';
                    echo routeLink('', 'Rincian Proses Peminjaman');
                } elseif ($_GET['page'] == "transactions") {
                    echo routeLink('', 'Transaksi Selesai');
                } elseif ($_GET['page'] == "transaction_detail") {
                    echo routeLink('index.php?page=transactions', 'Transaksi Selesai');
                    echo '<span>></span>';
                    echo routeLink('', 'Rincian Transaksi');
                } elseif ($_GET['page'] == "users") {
                    echo routeLink('', 'Pelanggan');
                } elseif ($_GET['page'] == "operators") {
                    echo routeLink('', 'Operator');
                } elseif ($_GET['page'] == "operator_add") {
                    echo routeLink('index.php?page=operators', 'Operator');
                    echo '<span>></span>';
                    echo routeLink('', 'Tambah Operator');
                } elseif ($_GET['page'] == "requirements") {
                    echo routeLink('index.php?page=requirements', 'Syarat & Ketentuan');
                } elseif ($_GET['page'] == "requirement_add") {
                    echo routeLink('index.php?page=requirements', 'Syarat & Ketentuan');
                    echo '<span>></span>';
                    echo routeLink('', 'Tambah Syarat');
                } elseif ($_GET['page'] == "requirement_edit") {
                    echo routeLink('index.php?page=requirements', 'Syarat & Ketentuan');
                    echo '<span>></span>';
                    echo routeLink('', 'Ubah Syarat');
                } else {

                }
            } else {
                echo routeLink('', 'Dashboard');
            }
        
            
        ?>
        

    </div>
    <div class="head-nav">
        <h2 id="menu-text">
        <?php 

            if (isset($_GET['page'])) {
                if ($_GET['page'] == "cars") {
                    echo 'Mobil';
                } elseif ($_GET['page'] == "car_add") {
                    echo 'Tambah Mobil';
                } elseif ($_GET['page'] == "car_edit") {
                    echo 'Ubah Mobil';
                } elseif ($_GET['page'] == "car_detail") {
                    echo 'Detail Mobil';
                } elseif ($_GET['page'] == "bookings") {
                    echo 'Pemesanan';
                } elseif ($_GET['page'] == "booking_detail") {
                    echo 'Rincian Pesanan';
                } elseif ($_GET['page'] == "ongoing") {
                    echo 'Proses Peminjaman';
                } elseif ($_GET['page'] == "ongoing_detail") {
                    echo 'Rincian Proses Peminjaman';
                } elseif ($_GET['page'] == "transactions") {
                    echo 'Transaksi Selesai';
                } elseif ($_GET['page'] == "transaction_detail") {
                    echo 'Rincian Transaksi';
                } elseif ($_GET['page'] == "users") {
                    echo 'Pelanggan';
                } elseif ($_GET['page'] == "operators") {
                    echo 'Operator';
                } elseif ($_GET['page'] == "operator_add") {
                    echo 'Tambah Operator';
                } elseif ($_GET['page'] == "operator_edit") {
                    echo 'Ubah Operator';
                }
            } else {
                echo 'Dashboard';
            }

        ?>
        </h2>
        <div class="logout-link">
            <a onclick="return confirm('Apakah anda ingin logout ?')" id="logout-link" href="logout.php"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout</a>
        </div>
    </div>
</body>
</html>
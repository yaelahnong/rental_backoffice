<?php 
    require 'functions.php';
    session_start();
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="company-name">
                <h3>Kujang Rent Car</h3>
            </div>
            <div class="profile">
                <div class="avatar">
                    <img src="img/<?= $_SESSION['foto']; ?>" alt="" width="100px" height="100px">
                </div>
                <div class="name">
                    <p><?= $_SESSION['nama']; ?></p>
                </div>
            </div>
            <div class="sidebar-menu">
                <div class="menu active"><a class="menu-link" href="index.php"><i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>Dashboard</a></div>
                <div class="menu"><a class="menu-link" href="index.php?page=cars"><i class="fa fa-car fa-fw" aria-hidden="true"></i>Mobil</a></div>
                <div class="menu"><a class="menu-link" href="index.php?page=bookings"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i>Pemesanan</a></div>
                <div class="menu"><a class="menu-link" href="index.php?page=ongoing"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Proses Peminjaman</a></div>
                <div class="menu"><a class="menu-link" href="index.php?page=transactions"><i class="fa fa-check fa-fw" aria-hidden="true"></i>Transaksi Selesai</a></div>
                <div class="menu"><a class="menu-link" href="index.php?page=users"><i class="fa fa-users fa-fw" aria-hidden="true"></i>Pelanggan</a></div>
                <?php if($_SESSION['level'] == 'admin'): ?>
                <div class="menu"><a class="menu-link" href="index.php?page=operators"><i class="fa fa-cogs fa-fw" aria-hidden="true"></i>Operator</a></div>
                <div class="menu"><a class="menu-link" href="index.php?page=requirements"><i class="fa fa-book" aria-hidden="true"></i>Syarat & Ketentuan</a></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="main-content">
            
            <?php 
                if (isset($_GET['page'])) {
                    if ($_GET['page'] == "cars") {
                        include 'cars.php';
                    } elseif ($_GET['page'] == "car_add") {
                        include 'car_add.php';
                    } elseif ($_GET['page'] == "car_edit") {
                        include 'car_edit.php';
                    } elseif ($_GET['page'] == "car_delete") {
                        include 'car_delete.php';
                    } elseif ($_GET['page'] == "car_detail") {
                        include 'car_detail.php';
                    } elseif ($_GET['page'] == "bookings") {
                        include 'booking_list.php';
                    } elseif ($_GET['page'] == "booking_detail") {
                        include 'booking_detail.php';
                    } elseif ($_GET['page'] == "ongoing") {
                        include 'ongoing_list.php';
                    } elseif ($_GET['page'] == "ongoing_detail") {
                        include 'ongoing_detail.php';
                    } elseif ($_GET['page'] == "transactions") {
                        include 'transactions.php';
                    } elseif ($_GET['page'] == "transaction_detail") {
                        include 'transaction_detail.php';
                    } elseif ($_GET['page'] == "users") {
                        include 'users.php';
                    } elseif ($_GET['page'] == "operators") {
                        include 'operators.php';
                    } elseif ($_GET['page'] == "operator_add") {
                        include 'operator_add.php';
                    } elseif ($_GET['page'] == "operator_delete") {
                        include 'operator_delete.php';
                    } elseif ($_GET['page'] == "requirements") {
                        include 'requirements.php';
                    } elseif ($_GET['page'] == "requirement_add") {
                        include 'requirement_add.php';
                    } elseif ($_GET['page'] == "requirement_edit") {
                        include 'requirement_edit.php';
                    } elseif ($_GET['page'] == "requirement_delete") {
                        include 'requirement_delete.php';
                    } else {
                        echo "error";
                    }
                } else {
                    include 'dashboard.php';
                }


            ?>
        </div>
    </div>
</body>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</html>
<?php 
    require_once('functions.php');
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }
    $count_transaksi = query("SELECT COUNT(tgl_pengembalian) AS count_transaksi FROM tb_detail_transaksi")[0];
    $pendapatan = query("SELECT SUM(total) AS jumlah_pendapatan FROM tb_detail_transaksi")[0];
    $pelanggan = query("SELECT COUNT(*) AS jumlah_pelanggan FROM tb_users WHERE level = 'user'")[0];
    $operator = query("SELECT COUNT(*) AS jumlah_operator FROM tb_users WHERE level = 'operator'")[0];
    $bulan = query("SELECT DATE_FORMAT(tgl_pengembalian, '%M') AS bulan FROM tb_detail_transaksi WHERE status = 1 GROUP BY date_format(tgl_pengembalian, '%M') ORDER BY tgl_pengembalian");
    $transaksi = query("SELECT MONTH(tgl_pengembalian) AS bulan, COUNT(*) AS jumlah_transaksi FROM tb_detail_transaksi WHERE status = 1 GROUP BY MONTH(tgl_pengembalian)");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    
    <style>
        .row {
            display: flex;
            flex-direction: column;
        }
        @media(min-width: 600px) {
            .row {
                flex-direction: row;
            }
        }
        .card.card-h {
            flex-direction: row;
            /* padding: 0px; */
            align-items: center;
        }
        .card.card-user {
            order: 3;
            background-color: #ffa000;
            color: #FDFEFF;
        }
        .card.card-income {
            order: 2;
            background-color: #388e3c;
            color: #FDFEFF;
        }
        .card.card-transaction {
            order: 1;
            background-color: #1976d2;
            color: #FDFEFF;
        }
        .card.card-operator {
            order: 4;
            background-color: #d32f2f;
            color: #FDFEFF;
        }
        .icon-description {
            margin-left: 20px;
            /* padding: 10px; */
        }
        .icon-number {
            font-size: 18px;
            font-weight: 600;
        }
        .icon-text {
            font-size: 14px;
            margin-top: 2px;
        }
        .card.transaction-chart h2 {
            margin: 0px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="dashboard">
        <div class="row row-1">
            <div class="card card-user card-h">
                <div class="icon">
                    <i class="fa fa-user-o fa-2x fa-fw" aria-hidden="true"></i>
                </div>
                <div class="icon-description">
                    <div class="icon-number"><?= $pelanggan['jumlah_pelanggan'] ?></div>
                    <div class="icon-text">Pelanggan</div>
                </div>
            </div>
            <div class="card card-income card-h">
                <div class="icon">
                    <i class="fa fa-money fa-2x fa-fw" aria-hidden="true"></i>
                </div>
                <div class="icon-description">
                    <div class="icon-number">Rp. <?= number_format($pendapatan['jumlah_pendapatan']); ?></div>
                    <div class="icon-text">Pendapatan</div>
                </div>
            </div>
            <div class="card card-transaction card-h">
                <div class="icon">
                    <i class="fa fa-line-chart fa-2x fa-fw" aria-hidden="true"></i>
                </div>
                <div class="icon-description">
                    <div class="icon-number"><?= $count_transaksi['count_transaksi']; ?></div>
                    <div class="icon-text">Jumlah Transaksi</div>
                </div>
            </div>
            <?php if($_SESSION['level'] == 'admin'): ?>
            <div class="card card-operator card-h">
                <div class="icon">
                    <i class="fa fa-cog fa-2x fa-fw" aria-hidden="true"></i>
                </div>
                <div class="icon-description">
                    <div class="icon-number"><?= $operator['jumlah_operator']; ?></div>
                    <div class="icon-text">Operator</div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="row row-2">
            <div class="card transaction-chart">
                <h2>Jumlah Transaksi Per Bulannya</h2>
                <canvas id="transactionChart"></canvas>
            </div>
        </div>
    </div>
</body>
<script src="js/Chart.js"></script>
<script>
    var ctx = document.getElementById('transactionChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: [<?php foreach($bulan as $bln) { echo "'" . $bln['bulan'] . "',"; } ?>],
        datasets: [{
            label: 'Jumlah Transaksi',
            backgroundColor: 'rgba(25, 118, 210, 0.5)',
            borderColor: 'rgb(25, 118, 210)',
            data: [<?php foreach($transaksi as $trs) { echo $trs['jumlah_transaksi'] . ','; } ?>]
        }]
    },

    // Configuration options go here
    options: {}
});
</script>
</html>
<?php 
    require_once('functions.php');
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

    $transaksi = query('SELECT tb_transaksi.*, tb_detail_transaksi.total, tb_users.nama FROM tb_transaksi, tb_detail_transaksi, tb_users WHERE status_transaksi = 1 AND tb_transaksi.kode_transaksi = tb_detail_transaksi.kode_transaksi AND tb_users.id_user = tb_transaksi.id_user ORDER BY tgl_pembayaran DESC');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <style>
        .searchbar {
            padding-bottom: 10px;
            display: flex;
            justify-content: flex-end;
        }
        .search-label {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="card">
        <!-- <div class="card-header">
            <a href="#"><i class="fa fa-plus fa-fw" aria-hidden="true"></i>Tambah</a>
        </div> -->
        <div class="searchbar">
            <label for="keyword" class="search-label">Search:</label>
            <input type="search" name="keyword" id="keyword" class="search-input" autocomplete="off">
        </div>
        <div id="container">
            <table class="table table-odd" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Transaksi</th>
                        <th>Nama</th>
                        <th>Total Pembayaran</th>
                        <th>Tgl Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php 
                    $i = 1; 
                    foreach($transaksi as $row):
                ?>
                <tbody>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row['kode_transaksi']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td>Rp. <?= number_format($row['total']); ?></td>
                        <td><?= $row['tgl_pembayaran']; ?></td>
                        <td>
                            <?php 
                                if($row['status_pembayaran'] == 1) { 
                                    echo "Lunas";
                                } else {
                                echo "Belum Lunas";
                                } 
                            ?>
                        </td>
                        <td><a href="index.php?page=transaction_detail&kode_transaksi=<?= $row['kode_transaksi']; ?>">Detail</a></td>
                    </tr>
                </tbody>
                <?php 
                    $i++;
                    endforeach;
                ?>
            </table>
        </div>
    </div>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/script.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
</body>
</html>
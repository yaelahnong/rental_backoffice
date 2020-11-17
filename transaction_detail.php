<?php 
    require_once('functions.php');
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

    if(isset($_GET['kode_transaksi'])) {
        $kode_transaksi = $_GET['kode_transaksi'];
    } else {
        header("Location: index.php?page=ongoing");
    }

    $detail_transaksi = query("SELECT * FROM v_detail_transaksi WHERE kode_transaksi = '$kode_transaksi'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .row {
            display: flex;
        }
        .row.row-2 {
            margin-top: 50px;
        }
        .col {
            flex: 1;
        }
        .table.table-detail {
            width: 100%;
        }
        .col-1 h2 {
            font-size: 24px;
            font-weight: 400;
            border-top: 1px solid #f4f4f4;
            margin: 0px;
            padding: 10px 0;
            
        }
        .table.table-detail tbody td {
            border-top: 1px solid #f4f4f4;
            padding: 10px 0;
            /* font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; */
        }
        .img-thumbnail {
            flex: 1;
            padding: 50px;
        }
        .detail-menu {
            margin-top: 20px;
            display: flex;
        }
        .detail-menu .button {
            width: 60px;
            padding: 10px;
            margin-right: 10px;
            display: flex;
        }
        .detail-menu .button a {
            margin: auto;
            text-decoration: none;
            color: #FDFEFF;
        }
        .detail-menu .button.button-3 a {
            color: #101010;
        }
        .detail-menu .button.button-1 {
            background-color: #3c8dbc;
        }
        .detail-menu .button.button-1:hover {
            background-color: #204d74;
        }
        .detail-menu .button.button-2 {
            background-color: #d9534f;
        }
        .detail-menu .button.button-2:hover {
            background-color: #d73925;
        }
        .detail-menu .button.button-3 {
            background-color: #f4f4f4;
        }
        .detail-menu .button.button-3:hover {
            background-color: #adadad;
        }
        .detail-menu .button:nth-child(3) {
            background-color: #f4f4f4;
            
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="card">
        <div class="row row-1">
            <div class="col col-1">
                <?php
                    $i = 1; 
                    foreach($detail_transaksi as $row):
                ?>
                
                <table class="table table-detail" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td><?= $row['nama'];  ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Order</td>
                            <td><?= $row['tgl_order'];  ?></td>
                        </tr>
                        <tr>
                            <td>Denda</td>
                            <td>Rp. <?= number_format($row['denda']);  ?></td>
                        </tr>
                        <tr>
                            <td>Harga Perhari</td>
                            <td>Rp. <?= number_format($row['harga_mobil']);  ?></td>
                        </tr>   
                        <tr>
                            <td>Jumlah hari</td>
                            <td>
                            <?php
                                $tgl_sewa = new DateTime($row['tgl_sewa']);
                                $tgl_akhir_penyewaan = new DateTime($row['tgl_akhir_penyewaan']);
                                $jumlah_hari = date_diff($tgl_sewa, $tgl_akhir_penyewaan);

                                echo $jumlah_hari->format('%d hari');  
                            ?>
                            </td>
                        </tr>   
                        <tr>
                            <td><strong>Total Pembayaran<strong></td>
                            <td>
                                <strong>Rp. <?= number_format($row['total']) ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>
                            <?php 
                                if($row['status_pembayaran'] == 1) {
                                    echo "Sudah Dibayar";
                                }  
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Status Transaksi</td>
                            <td>
                            <?php 
                                if($row['status_transaksi'] == 1) {
                                    echo "Selesai";
                                }  
                            ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>  
        </div>
        <div class="row row-2">
        <table class="table table-even" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mobil</th>
                            <th>Plat No Mobil</th>
                            <th>Tanggal Sewa</th>
                            <th>Tanggal Akhir Sewa</th>
                            <th>Tanggal Pengembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row['merk_mobil'] . ' ' . $row['nama_mobil']; ?></td>
                            <td><?= $row['plat_no_mobil']; ?></td>
                            <td><?= $row['tgl_sewa']; ?></td>
                            <td><?= $row['tgl_akhir_penyewaan']; ?></td>
                            <td><?= $row['tgl_pengembalian']; ?></td>
                        </tr>
                    </tbody>

                </table>
                    <?php 
                        $i++;
                        endforeach;
                    ?>
        </div>
    </div>
</body>
</html>
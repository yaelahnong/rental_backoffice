<?php 
    require_once('functions.php');
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header("Location: index.php?page=cars");
    }

    $mobil = query("SELECT * FROM tb_mobil WHERE id_mobil = '$id'");

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
        <div class="row">
            <div class="col col-1">
                <?php 
                    foreach($mobil as $row):
                ?>
                <h2>Detail <?= $row['merk_mobil'] . ' ' . $row['nama_mobil']; ?></h2>
                <table class="table table-detail" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>Nama Mobil</td>
                            <td><?= $row['nama_mobil']; ?></td>
                        </tr>
                        <tr>
                            <td>Merk Mobil</td>
                            <td><?= $row['merk_mobil']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Mobil</td>
                            <td><?= $row['jenis_mobil']; ?></td>
                        </tr>
                        <tr>
                            <td>Transmisi Mobil</td>
                            <td><?= $row['transmisi_mobil']; ?></td>
                        </tr>
                        <tr>
                            <td>Deskripsi Mobil</td>
                            <td><?= $row['deskripsi_mobil']; ?></td>
                        </tr>
                        <tr>
                            <td>Tahun Mobil</td>
                            <td><?= $row['tahun_mobil']; ?></td>
                        </tr>
                        <tr>
                            <td>Kapasitas Mobil</td>
                            <td><?= $row['kapasitas_mobil']; ?></td>
                        </tr>
                        <tr>
                            <td>Harga Mobil</td>
                            <td>Rp. <?= number_format($row['harga_mobil']); ?> / day</td>
                        </tr>
                        <tr>
                            <td>Warna Mobil</td>
                            <td><?= $row['warna_mobil']; ?></td>
                        </tr>
                        <tr>
                            <td>Plat No Mobil</td>
                            <td><?= $row['plat_no_mobil']; ?></td>
                        </tr>
                        <tr>
                            <td>Stok Mobil</td>
                            <td><?= $row['stok_mobil']; ?></td>
                        </tr>
                        <tr>
                            <td>Created At</td>
                            <td><?= $row['created_at']; ?></td>
                        </tr>
                        <tr>
                            <td>Updated At</td>
                            <td><?= $row['updated_at']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="detail-menu">
                    <div class="button button-1">
                        <a href="index.php?page=car_edit&id=<?= $row['id_mobil'] ?>">Ubah</i></a>
                    </div>
                    <?php if($_SESSION['level'] == 'admin'): ?>
                    <div class="button button-2">
                        <a onclick="return confirm(
                            'Apakah anda ingin menghapus <?= $row['merk_mobil'] . ' ' . $row['nama_mobil']; ?>?'
                        );" href="index.php?page=car_delete&id=<?= $row['id_mobil']; ?>">Hapus</a>
                    </div>
                    <?php endif; ?>
                    <div class="button button-3">
                        <a href="index.php?page=cars">Kembali</a>
                    </div>
                </div>
                    <?php 
                        endforeach;
                    ?>
            </div>
            <div class="col col-2">
                <div class="img-thumbnail">
                    <img src="img/<?= $row['foto_mobil']; ?>">
                </div>
            </div>      
        </div>
    </div>
</body>
</html>
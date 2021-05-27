<?php 
    require_once('functions.php');
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

    $mobil = query('SELECT * FROM tb_mobil');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="card">
        <div class="card-header">
            <a href="index.php?page=car_add"><i class="fa fa-plus fa-fw" aria-hidden="true"></i>Tambah Mobil</a>
        </div>
        <table class="table table-odd" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Stok Mobil</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php 
                $i = 1; 
                foreach($mobil as $row):
            ?>
            <tbody>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $row['merk_mobil'] . ' ' . $row['nama_mobil']; ?></td>
                    <td>Rp. <?= number_format($row['harga_mobil']); ?> / day</td>
                    <td><img src="img/<?= $row['foto_mobil']; ?>" width="100px" style="display: block; margin: 0 auto;"></td>
                    <td><?= $row['stok_mobil']; ?></td>
                    <td>
                        <a href="index.php?page=car_edit&id=<?= $row['id_mobil'] ?>"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i></a>
                        <a href="index.php?page=car_detail&id=<?= $row['id_mobil'] ?>"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i></a>
                        <?php if($_SESSION['level'] == 'admin'): ?>
                        <a onclick="return confirm(
                            'Apakah anda ingin menghapus <?= $row['merk_mobil'] . ' ' . $row['nama_mobil']; ?>?'
                        );" href="index.php?page=car_delete&id=<?= $row['id_mobil']; ?>"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
            <?php 
                $i++;
                endforeach;
            ?>
        </table>
    </div>
</body>
</html>
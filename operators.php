<?php 
    require_once('functions.php');
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

    $operator = query("SELECT * FROM tb_users WHERE level = 'operator'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="card">
        <div class="card-header">
            <a href="index.php?page=operator_add"><i class="fa fa-plus fa-fw" aria-hidden="true"></i>Tambah Operator</a>
        </div>
        <table class="table table-odd" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Operator</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php 
                $i = 1; 
                foreach($operator as $row):
            ?>
            <tbody>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['no_telp']; ?></td>
                    <td><?= $row['jenis_kelamin']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td>
                        <a onclick="return confirm('Apakah anda ingin menghapus <?= $row['nama']; ?> ?');" href="index.php?page=operator_delete&id=<?= $row['id_user']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
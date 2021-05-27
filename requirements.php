<?php 
    require_once('functions.php');
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

    $syarat = query("SELECT * FROM tb_syarat");

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
            <a href="index.php?page=requirement_add"><i class="fa fa-plus fa-fw" aria-hidden="true"></i>Tambah Syarat</a>
        </div>
        <table class="table table-odd" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Syarat</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php 
                $i = 1; 
                foreach($syarat as $row):
            ?>
            <tbody>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $row['syarat']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td><?= $row['updated_at']; ?></td>
                    <td>
                        <a href="index.php?page=requirement_edit&id=<?= $row['id_syarat'] ?>"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i></a>
                        <a onclick="return confirm('Apakah anda ingin menghapus <?= $row['syarat']; ?>?');" href="index.php?page=requirement_delete&id=<?= $row['id_syarat']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
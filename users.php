<?php 
    require_once('functions.php');
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

    $user = query("SELECT * FROM tb_users WHERE level = 'user'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="card">
        <!-- <div class="card-header">
            <a href="#"><i class="fa fa-plus fa-fw" aria-hidden="true"></i>Tambah Pelanggan</a>
        </div> -->
        <table class="table table-odd" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pelanggan </th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <?php 
                $i = 1; 
                foreach($user as $row):
            ?>
            <tbody>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['no_telp']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td><?= $row['updated_at']; ?></td>
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
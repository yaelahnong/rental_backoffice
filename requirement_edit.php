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

    $syarat = query("SELECT * FROM tb_syarat WHERE id_syarat = '$id'")[0];

    if(isset($_POST['ubah_syarat'])) {
        if( ubahSyarat($_POST) > 0 ) {
            echo "<script>
                alert('Data berhasil diubah.');
                document.location.href='index.php?page=requirements';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah.');
                document.location.href='index.php?page=requirements';
            </script>";
        }
    }
    date_default_timezone_set("Asia/Bangkok");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="card">
        <div class="form-input">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="hidden" name="id_syarat" value="<?= $syarat['id_syarat']; ?>">
                    <input type="hidden" name="updated_at" value="<?= date("Y-m-d H:i:s"); ?>">
                    <!-- <label for="syarat">Syarat</label> -->
                    <input type="text" id="syarat" name="syarat" placeholder="Syarat" value="<?= $syarat['syarat']; ?>">
                </div>
                <div class="btn-section">
                    <button type="submit" name="ubah_syarat">Ubah</button>
                    <a href="index.php?page=cars">Kembali</a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
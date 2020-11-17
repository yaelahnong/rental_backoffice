<?php 
    require_once('functions.php');
    
    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

    if(isset($_POST['tambah_operator'])) {
        if( tambahOperator($_POST) > 0 ) {
            echo "<script>
                alert('Data berhasil ditambahkan.');
                document.location.href='index.php?page=operators';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambahkan.');
                document.location.href='index.php?page=operator_add';
            </script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Operator</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="card">
        <div class="form-input">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="hidden" name="created_at" value="<?= date("Y-m-d H:i:s"); ?>">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Nama Lengkap">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="example@mail.com">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password">
                    <label for="no_telp">No Telp</label>
                    <input type="text" id="no_telp" name="no_telp" placeholder="08xxxx  ">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <div class="gender-input">
                        <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="laki-laki">Laki-laki
                        <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="perempuan">Perempuan
                    </div>
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="30" rows="5"></textarea>
                    <label for="foto">Foto</label>
                    <span class="input-info">*Max Size 1 Mb</span>
                    <input type="file" name="foto" id="foto">
                    <label for="level">Level</label>
                    <select name="level" id="level">
                        <option value="operator">Operator</option>
                    </select>
                </div>
                <div class="btn-section">
                    <button type="submit" name="tambah_operator">Tambah</button>
                    <a href="index.php?page=operators">Kembali</a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
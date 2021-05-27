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

    $mobil = query("SELECT * FROM tb_mobil WHERE id_mobil = '$id'")[0];

    if(isset($_POST['ubah_mobil'])) {
        if( ubahMobil($_POST) > 0 ) {
            echo "<script>
                alert('Data berhasil diubah.');
                document.location.href='index.php?page=cars';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah.');
                document.location.href='index.php?page=car_edit';
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
                    <input type="hidden" name="id_mobil" value="<?= $mobil['id_mobil']; ?>">
                    <input type="hidden" name="foto_mobil_lama" value="<?= $mobil['foto_mobil']; ?>">
                    <input type="hidden" name="updated_at" value="<?= date("Y-m-d H:i:s"); ?>">
                    <label for="nama_mobil">Nama Mobil</label>
                    <input type="text" id="nama_mobil" name="nama_mobil" placeholder="Nama Mobil" value="<?= $mobil['nama_mobil']; ?>">
                    <label for="merk_mobil">Merk Mobil</label>
                    <input type="text" id="merk_mobil" name="merk_mobil" placeholder="Merk Mobil" value="<?= $mobil['merk_mobil']; ?>">
                    <label for="jenis_mobil">Jenis Mobil</label>
                    <select name="jenis_mobil" id="jenis_mobil">
                        <option value="Sedan" <?php if($mobil['jenis_mobil'] == 'Sedan') { echo "selected"; } ?>>Sedan</option>
                        <option value="SUV" <?php if($mobil['jenis_mobil'] == 'SUV') { echo "selected"; } ?>>SUV</option>
                        <option value="Hatchback" <?php if($mobil['jenis_mobil'] == 'Hatchback') { echo "selected"; } ?>>Hatchback</option>
                        <option value="MPV" <?php if($mobil['jenis_mobil'] == 'MPV') { echo "selected"; } ?>>MPV</option>
                        <option value="Pickup" <?php if($mobil['jenis_mobil'] == 'Pickup Truck') { echo "selected"; } ?>>Pickup Truck</option>
                        <option value="Station Wagon" <?php if($mobil['jenis_mobil'] == 'Station Wagon') { echo "selected"; } ?>>Coupe</option>
                        <option value="Sports" <?php if($mobil['jenis_mobil'] == 'Sports') { echo "selected"; } ?>>Sports</option>
                        <option value="Convertible" <?php if($mobil['jenis_mobil'] == 'Convertible') { echo "selected"; } ?>>Convertible</option>
                    </select>
                    <label for="transmisi_mobil">Transmisi</label>
                    <input type="text" id="transmisi_mobil" name="transmisi_mobil" placeholder="Transmisi" value="<?= $mobil['transmisi_mobil']; ?>">
                    <label for="deskripsi_mobil">Deskripsi Mobil</label>
                    <textarea name="deskripsi_mobil" id="deskripsi_mobil" cols="30" rows="5"><?= $mobil['deskripsi_mobil']; ?></textarea>
                    <label for="tahun_mobil">Tahun Mobil</label>
                    <input type="text" id="tahun_mobil" name="tahun_mobil" placeholder="Tahun Mobil" value="<?= $mobil['tahun_mobil']; ?>">
                    <label for="kapasitas_mobil">Kapasitas Mobil</label>
                    <input type="number" id="kapasitas_mobil" name="kapasitas_mobil" placeholder="Kapasitas Mobil" value="<?= $mobil['kapasitas_mobil']; ?>">
                    <label for="harga_mobil">Harga Mobil</label>
                    <input type="text" id="harga_mobil" name="harga_mobil" placeholder="Harga Mobil" value="<?= $mobil['harga_mobil']; ?>">
                    <label for="warna_mobil">Warna Mobil</label>
                    <input type="text" id="warna_mobil" name="warna_mobil" placeholder="Warna Mobil" value="<?= $mobil['warna_mobil']; ?>">
                    <label for="plat_no_mobil">Plat Nomor Mobil</label>
                    <input type="text" id="plat_no_mobil" name="plat_no_mobil" placeholder="Plat Nomor Mobil" value="<?= $mobil['plat_no_mobil']; ?>">
                    <label for="Stok Mobil">Stok Mobil</label>
                    <!-- <span class="input-info">*0 = Tidak tersedia,  1 = Tersedia</span> -->
                    <input type="number" id="stok_mobil" name="stok_mobil" placeholder="Stok Mobil" value="<?= $mobil['stok_mobil']; ?>">
                    <label for="foto_mobil">Foto Mobil</label>
                    <input type="file" name="foto_mobil" id="foto_mobil">
                </div>
                <div class="btn-section">
                    <button type="submit" name="ubah_mobil">Ubah</button>
                    <a href="index.php?page=cars">Kembali</a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
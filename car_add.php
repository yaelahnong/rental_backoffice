<?php 
    require_once('functions.php');

    if(!$_SESSION['login']) {
        header('Location: login.php');
    }

    if(isset($_POST['tambah_mobil'])) {
        if( tambahMobil($_POST) > 0 ) {
            echo "<script>
                alert('Data berhasil ditambahkan.');
                document.location.href='index.php?page=cars';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambahkan.');
                document.location.href='index.php?page=cars_add';
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
            <form action="" method="post">
                <div class="input-group">
                    <input type="hidden" name="created_at" value="<?= date("Y-m-d H:i:s"); ?>">
                    <label for="nama_mobil">Nama Mobil</label>
                    <input type="text" id="nama_mobil" name="nama_mobil" placeholder="Nama Mobil">
                    <label for="merk_mobil">Merk Mobil</label>
                    <input type="text" id="merk_mobil" name="merk_mobil" placeholder="Merk Mobil">
                    <label for="jenis_mobil">Jenis Mobil</label>
                    <select name="jenis_mobil" id="jenis_mobil">
                        <option value="Sedan">Sedan</option>
                        <option value="SUV">SUV</option>
                        <option value="Hatchback">Hatchback</option>
                        <option value="MPV">MPV</option>
                        <option value="Pickup">Pickup Truck</option>
                        <option value="Station Wagon">Coupe</option>
                        <option value="Sports">Sports</option>
                        <option value="Convertible">Convertible</option>
                    </select>
                    <label for="transmisi_mobil">Transmisi</label>
                    <input type="text" id="transmisi_mobil" name="transmisi_mobil" placeholder="Transmisi">
                    <label for="deskripsi_mobil">Deskripsi Mobil</label>
                    <textarea name="deskripsi_mobil" id="deskripsi_mobil" cols="30" rows="5"></textarea>
                    <label for="tahun_mobil">Tahun Mobil</label>
                    <input type="text" id="tahun_mobil" name="tahun_mobil" placeholder="Tahun Mobil">
                    <label for="kapasitas_mobil">Kapasitas Mobil</label>
                    <input type="number" id="kapasitas_mobil" name="kapasitas_mobil" placeholder="Kapasitas Mobil">
                    <label for="harga_mobil">Harga Mobil</label>
                    <input type="text" id="harga_mobil" name="harga_mobil" placeholder="Harga Mobil">
                    <label for="warna_mobil">Warna Mobil</label>
                    <input type="text" id="warna_mobil" name="warna_mobil" placeholder="Warna Mobil">
                    <label for="plat_no_mobil">Plat Nomor Mobil</label>
                    <input type="text" id="plat_no_mobil" name="plat_no_mobil" placeholder="Plat Nomor Mobil">
                    <label for="stok_mobil">Stok Mobil</label>
                    <!-- <span class="input-info">*0 = Tidak tersedia,  1 = Tersedia</span> -->
                    <input type="number" id="stok_mobil" name="stok_mobil" placeholder="Stok Mobil">
                    <label for="foto_mobil">Foto Mobil</label>
                    <input type="file" name="foto_mobil" id="foto_mobil">
                </div>
                <div class="btn-section">
                    <button type="submit" name="tambah_mobil">Tambah</button>
                    <a href="index.php?page=cars">Kembali</a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
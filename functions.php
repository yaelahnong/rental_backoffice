<?php
    $conn = mysqli_connect('localhost', 'root', '', 'rental_project');

    function query($query) {
        global $conn;
        
        $result = mysqli_query($conn, $query);
        $rows = [];
        while( $row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function routeLink($url, $text) {
        return "<a href='$url' class='page-link active'>$text</a>";
    }

    function tambahOperator($data) {
        global $conn;

        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $no_telp = $_POST['no_telp'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $level = $_POST['level'];
        $created_at = $_POST['created_at'];

        // upload foto
        $foto = uploadOperator();

        if( !$foto ) {
            return false;
        }

        $result = mysqli_query($conn, "SELECT * FROM tb_users WHERE email = '$email'");

        if(mysqli_fetch_assoc($result)) {
            echo "<script>alert('Email sudah terdaftar!');</script>";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO tb_users(
                                nama, 
                                email, 
                                password, 
                                no_telp, 
                                jenis_kelamin, 
                                alamat, 
                                foto, 
                                level,
                                created_at
                            ) VALUES(
                                '$nama', 
                                '$email',
                                '$password',
                                '$no_telp',
                                '$jenis_kelamin',
                                '$alamat',
                                '$foto',
                                '$level',
                                '$created_at'
                            )";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);

    }

    function uploadOperator() {
        
        $namaFile = $_FILES['foto']['name'];
        $ukuranFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmpName = $_FILES['foto']['tmp_name'];

        // cek apakah ada foto yang di upload
        // 4 = tidak ada gambar yang di upload (error message)
        if( $error === 4 ) {
            echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>";
            return false;
        }

        // cek apakah foto yang diupload adalah gambar
        $ekstensiFotoValid = ['jpg', 'jpeg', 'png'];
        
        // mengambil ekstensi gambar dari nama file
        $ekstensiFoto = explode('.', $namaFile);
        $ekstensiFoto = strtolower(end($ekstensiFoto));
        
        // cek apakah ekstensi gambar valid
        if( !in_array($ekstensiFoto, $ekstensiFotoValid) ) {
            echo "<script>
                alert('Yang anda upload bukan gambar!');
            </script>";
            return false;
        }
        
        // cek ukuran gambar (byte)
        if( $ukuranFile > 1000000) {
            echo "<script>
                alert('Ukuran gambar terlalu besar!');
            </script>";
            return false;
        }

        // gambar valid, siap di upload
        // generate nama file baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiFoto;
        
        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

        return $namaFile;

    }

    function hapusOperator($id) {
        global $conn;

        mysqli_query($conn, "DELETE FROM tb_users WHERE id_user = '$id'");
        return mysqli_affected_rows($conn);
    }

    function tambahMobil($data) {
        global $conn;
        
        $nama_mobil = $_POST['nama_mobil'];
        $merk_mobil = $_POST['merk_mobil'];
        $jenis_mobil = $_POST['jenis_mobil'];
        $transmisi_mobil = $_POST['transmisi_mobil'];
        $deskripsi_mobil = $_POST['deskripsi_mobil'];
        $tahun_mobil = $_POST['tahun_mobil'];
        $kapasitas_mobil = $_POST['kapasitas_mobil'];
        $harga_mobil = $_POST['harga_mobil'];
        $warna_mobil = $_POST['warna_mobil'];
        $plat_no_mobil = $_POST['plat_no_mobil'];
        $status_mobil = $_POST['status_mobil'];
        $foto_mobil = $_POST['foto_mobil'];
        $created_at = $_POST['created_at'];
        
        $result = mysqli_query($conn, "SELECT * FROM tb_mobil WHERE plat_no_mobil = '$plat_no_mobil'");

        if(mysqli_fetch_assoc($result)) {
            echo "<script>alert('Mobil sudah terdaftar!');</script>";
            return false;
        }

        $query = "INSERT INTO tb_mobil(
                        nama_mobil, 
                        merk_mobil, 
                        jenis_mobil, 
                        transmisi_mobil, 
                        deskripsi_mobil,
                        tahun_mobil,
                        kapasitas_mobil,
                        harga_mobil,
                        warna_mobil,
                        plat_no_mobil,
                        status_mobil,
                        foto_mobil, 
                        created_at
                        ) VALUES (
                        '$nama_mobil',
                        '$merk_mobil',
                        '$jenis_mobil',
                        '$transmisi_mobil',
                        '$deskripsi_mobil',
                        '$tahun_mobil',
                        '$kapasitas_mobil',
                        '$harga_mobil',
                        '$warna_mobil',
                        '$plat_no_mobil',
                        '$status_mobil',
                        '$foto_mobil',
                        '$created_at'
                    )";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);


    }

    function ubahMobil($data){
        global $conn;

        $id_mobil = $data['id_mobil'];
        $nama_mobil = $_POST['nama_mobil'];
        $merk_mobil = $_POST['merk_mobil'];
        $jenis_mobil = $_POST['jenis_mobil'];
        $transmisi_mobil = $_POST['transmisi_mobil'];
        $deskripsi_mobil = $_POST['deskripsi_mobil'];
        $tahun_mobil = $_POST['tahun_mobil'];
        $kapasitas_mobil = $_POST['kapasitas_mobil'];
        $harga_mobil = $_POST['harga_mobil'];
        $warna_mobil = $_POST['warna_mobil'];
        $plat_no_mobil = $_POST['plat_no_mobil'];
        $status_mobil = $_POST['status_mobil'];
        $updated_at = $_POST['updated_at'];
        $foto_mobil_lama = $data['foto_mobil_lama'];

        // cek apakah upload foto baru atau tidak
        // 4 = tidak mengupload gambar
        if($_FILES['foto_mobil']['error'] === 4) {
            $foto_mobil = $foto_mobil_lama;
        } else {
            $foto_mobil = uploadMobil();
        }

        if( !$foto_mobil ) {
            return false;
        }

        $query = "UPDATE tb_mobil
                    SET 
                    nama_mobil = '$nama_mobil',
                    merk_mobil = '$merk_mobil',
                    jenis_mobil = '$jenis_mobil',
                    transmisi_mobil = '$transmisi_mobil',
                    deskripsi_mobil = '$deskripsi_mobil',
                    tahun_mobil = '$tahun_mobil',
                    kapasitas_mobil = '$kapasitas_mobil',
                    harga_mobil = '$harga_mobil',
                    warna_mobil = '$warna_mobil',
                    plat_no_mobil = '$plat_no_mobil',
                    status_mobil = '$status_mobil',
                    foto_mobil = '$foto_mobil',
                    updated_at = '$updated_at'
                    WHERE id_mobil = '$id_mobil'
                ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function uploadMobil() {
        
        $namaFile = $_FILES['foto_mobil']['name'];
        $ukuranFile = $_FILES['foto_mobil']['size'];
        $error = $_FILES['foto_mobil']['error'];
        $tmpName = $_FILES['foto_mobil']['tmp_name'];

        // cek apakah ada foto yang di upload
        // 4 = tidak ada gambar yang di upload (error message)
        if( $error === 4 ) {
            echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>";
            return false;
        }

        // cek apakah foto yang diupload adalah gambar
        $ekstensiFotoValid = ['jpg', 'jpeg', 'png'];
        
        // mengambil ekstensi gambar dari nama file
        $ekstensiFoto = explode('.', $namaFile);
        $ekstensiFoto = strtolower(end($ekstensiFoto));
        
        // cek apakah ekstensi gambar valid
        if( !in_array($ekstensiFoto, $ekstensiFotoValid) ) {
            echo "<script>
                alert('Yang anda upload bukan gambar!');
            </script>";
            return false;
        }
        
        // cek ukuran gambar (byte)
        if( $ukuranFile > 1000000) {
            echo "<script>
                alert('Ukuran gambar terlalu besar!');
            </script>";
            return false;
        }

        // gambar valid, siap di upload
        
        move_uploaded_file($tmpName, 'img/' . $namaFile);

        return $namaFile;

    }

    function hapusMobil($id) {
        global $conn;

        mysqli_query($conn, "DELETE FROM tb_mobil WHERE id_mobil = '$id'");
        return mysqli_affected_rows($conn);
    }

    function bookingConfirm($data) {
        global $conn;

        $kode_transaksi = $_POST['kode_transaksi'];
        $id_user = $_POST['id_user'];
        $tgl_order = $_POST['tgl_order'];
        $total_pembayaran = $_POST['total_pembayaran'];
        $tgl_pembayaran = $_POST['tgl_pembayaran'];
        $status_pembayaran = $_POST['status_pembayaran'];
        $status_transaksi = $_POST['status_transaksi'];
        $updated_at = $_POST['updated_at'];

        $query = "UPDATE tb_transaksi
                    SET
                    id_user = '$id_user',
                    tgl_order = '$tgl_order',
                    total_pembayaran = '$total_pembayaran',
                    tgl_pembayaran = '$tgl_pembayaran',
                    status_pembayaran = '$status_pembayaran',
                    status_transaksi = '$status_transaksi',
                    updated_at = '$updated_at'
                    WHERE kode_transaksi = '$kode_transaksi'
                ";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function ongoingConfirm($data) {
        global $conn;

        $id_user = $_POST['id_user'];
        $tgl_order = $_POST['tgl_order'];
        $total_pembayaran = $_POST['total_pembayaran'];
        $tgl_pembayaran = $_POST['tgl_pembayaran'];
        $status_pembayaran = $_POST['status_pembayaran'];
        $status_transaksi = $_POST['status_transaksi'];
        
        $kode_transaksi = $_POST['kode_transaksi'];
        $updated_at = $_POST['updated_at'];

        $id_detail_transaksi = $_POST['id_detail_transaksi'];
        $id_mobil = $_POST['id_mobil'];
        $tgl_sewa = $_POST['tgl_sewa'];
        $tgl_akhir_penyewaan = $_POST['tgl_akhir_penyewaan'];
        $tgl_pengembalian = $_POST['tgl_pengembalian'];
        $denda = $_POST['denda'];
        $total = $_POST['total'];
        $status = $_POST['status'];

        $query1 = "UPDATE tb_transaksi
                    SET
                    id_user = '$id_user',
                    tgl_order = '$tgl_order',
                    total_pembayaran = '$total_pembayaran',
                    tgl_pembayaran = '$tgl_pembayaran',
                    status_pembayaran = '$status_pembayaran',
                    status_transaksi = '$status_transaksi',
                    updated_at = '$updated_at'
                    WHERE kode_transaksi = '$kode_transaksi'
                ";
        
        $query2 = "UPDATE tb_detail_transaksi
                    SET
                    kode_transaksi = '$kode_transaksi',
                    id_mobil = '$id_mobil',
                    tgl_sewa = '$tgl_sewa',
                    tgl_akhir_penyewaan = '$tgl_akhir_penyewaan',
                    tgl_pengembalian = '$tgl_pengembalian',
                    denda = '$denda',
                    total = '$total',
                    status = '$status',
                    updated_at = '$updated_at'
                    WHERE id_detail_transaksi = '$id_detail_transaksi'
                ";
        
        mysqli_query($conn, $query1);

        mysqli_query($conn, $query2);

        return mysqli_affected_rows($conn);
    }
    
?>
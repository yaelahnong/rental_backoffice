<?php 
    require '../functions.php';

    $keyword = $_GET["keyword"];

    $query = "SELECT tb_transaksi.*, tb_users.nama 
    FROM tb_transaksi, tb_users 
    WHERE status_pembayaran = 1
    AND status_transaksi = 0 
    AND tb_transaksi.kode_transaksi LIKE '%$keyword%' 
    AND tb_users.id_user = tb_transaksi.id_user 
    ORDER BY tgl_order DESC";

    $transaksi = query($query);

?>
    <table class="table table-odd" cellspacing="0">
        <!-- <div class="card-header">
            <a href="#"><i class="fa fa-plus fa-fw" aria-hidden="true"></i>Tambah</a>
        </div> -->
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Transaksi</th>
                <th>Nama</th>
                <th>Total Pembayaran</th>
                <th>Tgl Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php 
            $i = 1; 
            foreach($transaksi as $row):
        ?>
        <tbody>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $row['kode_transaksi']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td>Rp. <?= number_format($row['total_pembayaran']); ?></td>
                <td><?= $row['tgl_pembayaran']; ?></td>
                <td>
                    <?php 
                        if($row['status_pembayaran'] == 1) { 
                            echo "Lunas";
                        } else {
                            echo "Belum Lunas";
                        } 
                    ?>
                </td>
                <td><a href="index.php?page=ongoing_detail&kode_transaksi=<?= $row['kode_transaksi']; ?>">Detail</a></td>
            </tr>
        </tbody>
            <?php 
                $i++;
                endforeach;
            ?>
    </table>
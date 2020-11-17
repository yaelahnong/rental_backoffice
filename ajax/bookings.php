<?php 
    require '../functions.php';

    $keyword = $_GET['keyword'];

    $transaksi = query("SELECT tb_transaksi.*, tb_users.nama, tb_detail_transaksi.tgl_sewa 
                        FROM tb_transaksi, tb_users, tb_detail_transaksi 
                        WHERE status_pembayaran = 0
                        AND tb_transaksi.kode_transaksi LIKE '%$keyword%'
                        AND tb_users.id_user = tb_transaksi.id_user 
                        AND tb_transaksi.kode_transaksi = tb_detail_transaksi.kode_transaksi
                        AND datediff(now(), tgl_sewa) < 1 
                        ORDER BY tgl_order DESC");

?>

        <table class="table table-odd" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Transaksi</th>
                    <th>Nama</th>
                    <th>Tgl Order</th>
                    <th>Total Pembayaran</th>
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
                    <td><?= $row['tgl_order']; ?></td>
                    <td>Rp. <?= number_format($row['total_pembayaran']); ?></td>
                    <td>
                        <?php 
                            if($row['status_pembayaran'] == 1) {
                                echo "Lunas";
                            } else {
                                echo "Belum Lunas";
                            } 
                        ?>
                    </td>
                    <td><a href="index.php?page=booking_detail&kode_transaksi=<?= $row['kode_transaksi']; ?>">Detail</a></td>
                </tr>
            </tbody>
            <?php 
                $i++;
                endforeach;
            ?>
        </table>
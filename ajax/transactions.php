<?php 
    require '../functions.php';

    $keyword = $_GET["keyword"];

    $query = "SELECT tb_transaksi.*, tb_detail_transaksi.total, tb_users.nama 
                FROM tb_transaksi, tb_detail_transaksi, tb_users 
                WHERE status_transaksi = 1 
                AND 
                tb_transaksi.kode_transaksi LIKE '%$keyword%'
                AND tb_transaksi.kode_transaksi = tb_detail_transaksi.kode_transaksi 
                AND tb_users.id_user = tb_transaksi.id_user 
                ORDER BY tgl_pembayaran DESC
            ";
    $transaksi = query($query);

?>


    <table class="table table-odd" cellspacing="0">
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
                <td>Rp. <?= number_format($row['total']); ?></td>
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
                <td><a href="index.php?page=transaction_detail&kode_transaksi=<?= $row['kode_transaksi']; ?>">Detail</a></td>
            </tr>
        </tbody>
        <?php 
            $i++;
            endforeach;
        ?>
    </table>
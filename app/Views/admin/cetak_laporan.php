<?php if ($servis): ?>
    <h3>Rekap Servis <?= $start ? "($start s.d. $end)" : '' ?></h3>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <tr>
            <th>No</th><th>Tanggal</th><th>Nama</th><th>No Polisi</th><th>Servis</th><th>Biaya</th>
        </tr>
        <?php 
        $no = 1; $total = 0;
        foreach ($servis as $row): 
            $total += $row['biaya'];
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($row['tanggal_servis']) ?></td>
            <td><?= esc($row['nama_pelanggan']) ?></td>
            <td><?= esc($row['no_polisi']) ?></td>
            <td><?= esc($row['jenis_servis']) ?></td>
            <td>Rp <?= number_format($row['biaya'], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="5"><strong>Total</strong></td>
            <td><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
        </tr>
    </table>
    <br>
    <a href="/admin/cetakLaporan?<?= $_SERVER['QUERY_STRING'] ?>" target="_blank">🖨️ Cetak</a>
<?php else: ?>
    <p><em>Tidak ada data ditemukan.</em></p>
<?php endif ?>

<?php if (!empty($servis)) : ?>
<table border="1" cellpadding="8" width="100%">
    <tr style="background: #eee;">
        <th>No</th><th>Nama</th><th>No Polisi</th><th>Tanggal</th><th>Jenis Servis</th><th>Biaya</th><th>Aksi</th>
    </tr>
    <?php $no=1; foreach($servis as $s): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= esc($s['nama_pelanggan']) ?></td>
        <td><?= esc($s['no_polisi']) ?></td>
        <td><?= esc($s['tanggal_servis']) ?></td>
        <td><?= esc($s['jenis_servis']) ?></td>
        <td>Rp <?= number_format($s['biaya']) ?></td>
        <td><button onclick="cetakNota(<?= $s['id'] ?>)">🧾 Cetak</button></td>
    </tr>
    <?php endforeach ?>
</table>
<?php else : ?>
<p><em>Data tidak ditemukan.</em></p>
<?php endif ?>

<script>
function cetakNota(id) {
    window.open('/admin/cetak-nota/' + id, '_blank');
}
</script>

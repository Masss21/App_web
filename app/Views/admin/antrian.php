<h2>📋 Antrian Masuk</h2>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <tr style="background: #eee;">
        <th>No</th>
        <th>Nama</th>
        <th>Telepon</th> <!-- Tambahkan kolom ini -->
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php if (!empty($antrian)) : ?>
        <?php $no = 1; foreach ($antrian as $row): ?>
        <tr id="row-<?= $row['id'] ?>">
    <td><?= $no++ ?></td>
    <td><?= esc($row['nama']) ?></td>
    <td><?= esc($row['telepon']) ?></td>
    <td><?= esc($row['tanggal']) ?></td>
    <td><?= esc($row['status']) ?></td>
    <td>
    <button class="btn-proses" data-id="<?= $row['id'] ?>">Proses</button>
    <button class="btn-hapus" data-id="<?= $row['id'] ?>">Hapus</button>
</td>

</tr>

        <?php endforeach ?>
    <?php else : ?>
        <tr><td colspan="6">Belum ada antrian.</td></tr>
    <?php endif ?>
</table>

<script>
console.log('Halaman antrian dimuat'); // Ini harus muncul setiap kali loadPage('antrian') dipanggil
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



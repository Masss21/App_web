<h2>🔧 Data Servis</h2>

<button id="btnTambahServis" onclick="toggleFormServis()">+ Tambah Servis</button>

<div id="formServisContainer" style="margin-top: 20px;"></div>

<table border="1" cellpadding="8" width="100%" style="margin-top: 10px;">
    <tr style="background: #eee;">
        <th>No</th>
        <th>Tanggal</th>
        <th>Kendaraan</th>
        <th>Jenis Servis</th>
        <th>Biaya</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1; foreach ($servis as $s): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= esc($s['tanggal_servis']) ?></td>
        <td><?= esc($s['no_polisi']) ?> - <?= esc($s['merk']) ?></td>
        <td><?= esc($s['jenis_servis']) ?></td>
        <td>Rp <?= number_format($s['biaya'], 0, ',', '.') ?></td>
        <td>
            <button onclick="editServis(<?= $s['id'] ?>)">Edit</button>
            <button onclick="hapusServis(<?= $s['id'] ?>)">Hapus</button>
        </td>
    </tr>
    <?php endforeach ?>
</table>

<script>
let formServisTerbuka = false;

function toggleFormServis() {
    if (formServisTerbuka) {
        $('#formServisContainer').slideUp().html('');
        $('#btnTambahServis').text('+ Tambah Servis');
        formServisTerbuka = false;
        return;
    }

    $.get('/admin/form-servis', function (html) {
        $('#formServisContainer').hide().html(html).slideDown();
        $('#btnTambahServis').text('× Tutup Form');
        formServisTerbuka = true;
    });
}

function editServis(id) {
    $.get('/admin/form-servis/' + id, function (html) {
        $('#formServisContainer').hide().html(html).slideDown();
        $('#btnTambahServis').text('× Tutup Form');
        formServisTerbuka = true;
    });
}

function hapusServis(id) {
    if (confirm('Yakin hapus servis ini?')) {
        $.post('/admin/delete-servis/' + id, function () {
            showToast('Data berhasil dihapus');
            loadPage('servis');
        });
    }
}
</script>

<h2>🚘 Data Kendaraan</h2>

<button id="btnTambahKendaraan" onclick="showFormKendaraan()">+ Tambah Kendaraan</button>

<div id="formKendaraanContainer" style="margin-top: 20px;"></div>

<table border="1" cellpadding="8" width="100%" style="margin-top: 10px;">
    <tr style="background: #eee;">
        <th>No</th>
        <th>No Polisi</th>
        <th>Merk</th>
        <th>Tipe</th>
        <th>Tahun</th>
        <th>Pemilik</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1; foreach ($kendaraan as $k): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($k['no_polisi']) ?></td>
            <td><?= esc($k['merk']) ?></td>
            <td><?= esc($k['tipe']) ?></td>
            <td><?= esc($k['tahun']) ?></td>
            <td><?= esc($k['nama_pelanggan']) ?></td>
            <td>
                <button onclick="editKendaraan(<?= $k['id'] ?>)">Edit</button>
                <button onclick="hapusKendaraan(<?= $k['id'] ?>)">Hapus</button>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<script>
function showFormKendaraan() {
    $.get('/admin/form-kendaraan', function (html) {
        $('#formKendaraanContainer').html(html);
        setTimeout(() => {
            document.getElementById('formKendaraanContainer').scrollIntoView({ behavior: 'smooth' });
        }, 100);
    });
}

function editKendaraan(id) {
    $.get('/admin/form-kendaraan/' + id, function (html) {
        $('#formKendaraanContainer').html(html);
        setTimeout(() => {
            document.getElementById('formKendaraanContainer').scrollIntoView({ behavior: 'smooth' });
        }, 100);
    });
}

function hapusKendaraan(id) {
    if (confirm('Yakin hapus data ini?')) {
        $.post('/admin/delete-kendaraan/' + id, function () {
            loadPage('kendaraan');
        });
    }
}
</script>

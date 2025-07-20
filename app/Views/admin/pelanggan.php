<h2>👤 Data Pelanggan</h2>

<button onclick="showForm()">+ Tambah Pelanggan</button>
<div id="formContainer" style="margin-top: 20px;"></div>
<table border="1" cellpadding="8" width="100%" style="margin-top: 10px;">
    <tr style="background: #eee;">
        <th>No</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1; foreach ($pelanggan as $p): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($p['nama']) ?></td>
            <td><?= esc($p['telepon']) ?></td>
            <td>
                <button onclick="editPelanggan(<?= $p['id'] ?>)">Edit</button>
                <button onclick="hapusPelanggan(<?= $p['id'] ?>)">Hapus</button>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<div id="formContainer" style="margin-top: 20px;"></div>

<script>
let formTerbuka = false;

function showForm() {
    if (formTerbuka) {
        $('#formContainer').slideUp().html('');
        $('#btnTambah').text('+ Tambah Pelanggan');
        formTerbuka = false;
        return;
    }

    $.get('/admin/form-pelanggan', function (html) {
        $('#formContainer').hide().html(html).slideDown();

        // Scroll otomatis ke form
        $('html, body').animate({
            scrollTop: $('#formContainer').offset().top - 50
        }, 400);

        $('#btnTambah').text('Tutup Form');
        formTerbuka = true;
    });
}

function editPelanggan(id) {
    $.get('/admin/form-pelanggan/' + id, function (html) {
        $('#formContainer').hide().html(html).slideDown();

        $('html, body').animate({
            scrollTop: $('#formContainer').offset().top - 50
        }, 400);

        $('#btnTambah').text('Tutup Form');
        formTerbuka = true;
    });
}

function hapusPelanggan(id) {
    if (confirm('Yakin ingin menghapus pelanggan ini?')) {
        $.post('/admin/delete-pelanggan', { id: id }, function () {
            showToast('Data berhasil dihapus');
            loadPage('pelanggan');
        });
    }
}
</script>


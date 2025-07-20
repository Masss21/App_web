

<form id="formPelanggan">
    <input type="hidden" name="id" value="<?= $pelanggan['id'] ?? '' ?>">

    <div class="form-row">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" class="column" required value="<?= $pelanggan['nama'] ?? '' ?>">

        <label for="telepon">Telepon</label>
        <input type="text" id="telepon" name="telepon" class="column" required value="<?= $pelanggan['telepon'] ?? '' ?>">

    <div class="form-row button-row">
        <button type="submit" class="btn-kecil">Simpan</button>
        </div>
    </div>
</form>

<script>
$('#formPelanggan').on('submit', function (e) {
    e.preventDefault();

    $.post('/admin/save-pelanggan', $(this).serialize(), function () {
        showToast('Data berhasil disimpan');
        loadPage('pelanggan'); // reload halaman pelanggan untuk memperbarui tabel
    });
});
</script>


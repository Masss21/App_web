<form method="post" action="/admin/save-kendaraan" id="formKendaraan">
    <input type="hidden" name="id" value="<?= $kendaraan['id'] ?? '' ?>">

    <div class="form-row">
        <label>No Polisi</label>
        <input type="text" name="no_polisi" class="column" required value="<?= $kendaraan['no_polisi'] ?? '' ?>"><br>

        <label>Merk</label>
        <input type="text" name="merk" class="column" required value="<?= $kendaraan['merk'] ?? '' ?>"><br>

        <label>Tipe</label>
        <input type="text" name="tipe" class="column" required value="<?= $kendaraan['tipe'] ?? '' ?>"><br>

        <label>Tahun</label>
        <input type="text" name="tahun" class="column" required value="<?= $kendaraan['tahun'] ?? '' ?>"><br>

        <label>Pemilik</label>
        <select name="id_pelanggan" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php foreach ($pelanggan as $p): ?>
                <option value="<?= $p['id'] ?>" <?= isset($kendaraan) && $kendaraan['id_pelanggan'] == $p['id'] ? 'selected' : '' ?>>
                    <?= esc($p['nama']) ?>
                </option>
            <?php endforeach ?>
        </select><br>

        <div class="form-row button-row">
            <button type="submit" class="btn-kecil">Simpan</button>
        </div>
    </div>
</form>

<script>
$('#formKendaraan').on('submit', function (e) {
    e.preventDefault();
    $.post('/admin/save-kendaraan', $(this).serialize(), function () {
        // reload data dan sembunyikan form setelah submit
        loadPage('kendaraan');
    });
});
</script>

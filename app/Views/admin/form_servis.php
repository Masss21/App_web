<form method="post" action="/admin/save-servis" id="formServis">
    <input type="hidden" name="id" value="<?= $servis['id'] ?? '' ?>">
    
    <div class="form-row">
        <label>Kendaraan</label>
        <select name="id_kendaraan" required>
            <option value="">-- Pilih Kendaraan --</option>
            <?php foreach ($kendaraan as $k): ?>
                <option value="<?= $k['id'] ?>" <?= isset($servis) && $servis['id_kendaraan'] == $k['id'] ? 'selected' : '' ?>>
                    <?= esc($k['no_polisi']) ?> - <?= esc($k['merk']) ?>
                </option>
            <?php endforeach ?>
        </select>

        <label>Tanggal Servis</label>
        <input type="date" name="tanggal_servis" required value="<?= $servis['tanggal_servis'] ?? date('Y-m-d') ?>">

        <label>Jenis Servis</label>
        <select name="jenis_servis" required>
            <option value="">-- Pilih Jenis --</option>
            <?php
            $list = [
    'Tune up',
    'Bore up',
    'Stroke up',
    'Overhaul',
    'Brake Maintenance',
    'Oil Engine And Transmission',
    'Maintenance Suspension',
    'Balancing And Spooring'
];

            foreach ($list as $item) :
            ?>
                <option value="<?= $item ?>" <?= isset($servis) && $servis['jenis_servis'] == $item ? 'selected' : '' ?>>
                    <?= $item ?>
                </option>
            <?php endforeach ?>
        </select>

        <label>Biaya Servis</label>
        <input type="number" name="biaya" required value="<?= $servis['biaya'] ?? '' ?>">

    <div class="form-row button-row">
        <button type="submit">Simpan</button>
        </div>
    </div>
</form>

<script>
initFormServis();
</script>

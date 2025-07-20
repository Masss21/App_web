<h2>📈 Laporan Servis</h2>

<form id="formCari">
    <label>Dari Tanggal</label>
    <input type="date" name="start" required style="width: 280px">
    <label>Sampai Tanggal</label>
    <input type="date" name="end" required style="width: 280px">
    <button type="submit style=" width: 100px;">Cari</button>
</form>

<div id="hasilLaporan" style="margin-top: 20px;"></div>

<script>
$('#formCari').on('submit', function (e) {
    e.preventDefault();

    const params = $(this).serialize();

    $.get('/admin/cari-laporan?' + params, function (html) {
        $('#hasilLaporan').html(html);
    });
});
</script>

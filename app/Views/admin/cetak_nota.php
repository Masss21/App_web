<!DOCTYPE html>
<html>
<head>
    <title>Nota Servis</title>
    <style>
        body { font-family: sans-serif; padding: 40px; }
        h2 { margin-bottom: 20px; }
        table { width: 100%; }
        td { padding: 5px 0; }
    </style>
</head>
<body>

    <h2>Nota Servis Kendaraan</h2>

    <table>
        <tr><td>Nama Pelanggan</td><td>: <?= esc($servis['nama_pelanggan']) ?></td></tr>
        <tr><td>No Polisi</td><td>: <?= esc($servis['no_polisi']) ?></td></tr>
        <tr><td>Jenis Servis</td><td>: <?= esc($servis['jenis_servis']) ?></td></tr>
        <tr><td>Biaya</td><td>: Rp <?= number_format($servis['biaya']) ?></td></tr>
        <tr><td>Tanggal Servis</td><td>: <?= esc($servis['tanggal_servis']) ?></td></tr>
    </table>

    <br><br>
    <p>Terima kasih telah mempercayakan layanan kami.</p>

    <script>
        window.print();
    </script>

</body>
</html>

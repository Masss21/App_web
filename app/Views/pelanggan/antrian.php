<!DOCTYPE html>
<html>
<head>
    <title>Form Antrian</title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        input, button { padding: 10px; margin: 10px; width: 300px; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Form Pengambilan Antrian</h1>
    <form method="post" action="/pelanggan/submit-antrian">
        <input type="text" name="nama" placeholder="Nama Lengkap" required><br>
        <input type="text" name="telepon" placeholder="Nomor Telepon" required><br>
        <button type="submit">Ambil Antrian</button>
    </form>

    <?php if (session()->getFlashdata('success')): ?>
        <p class="success"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <br>
    <a href="/">⬅️ Kembali ke Beranda</a>

</body>
</html>

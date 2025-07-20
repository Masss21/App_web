<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

<h1>Selamat datang, Admin!</h1>
<div class="dashboard-stats">
    <div class="stat-card">👥<h4>Total Customer</h4><p><?= $total_customer ?></p></div>
    <div class="stat-card">🚘<h4>Total Kendaraan</h4><p><?= $total_kendaraan ?></p></div>
    <div class="stat-card">📋<h4>Antrian Masuk</h4><p><?= $total_antrian ?></p></div>
    <div class="stat-card">⏳<h4>Antrian Pending</h4><p><?= $total_pending ?></p></div>
</div>

<p>Selamat datang kembali, admin!</p>

</body>
</html>

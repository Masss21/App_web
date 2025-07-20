<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
    <script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
</head>
<body>

<button id="toggleNav" class="toggle-button">☰</button>

<aside id="sidebar">
    <h3 class="judul">Navigasi</h3>
    <a href="#" onclick="loadPage('dashboard')">🏠 Dashboard</a>
    <a href="#" onclick="loadPage('antrian')">📋 Antrian</a>
    <a href="#" onclick="loadPage('pelanggan')">👤 Pelanggan</a>
    <a href="#" onclick="loadPage('kendaraan')">🚘 Kendaraan</a>
    <a href="#" onclick="loadPage('servis')">🔧 Servis</a>
    <a href="#" onclick="loadPage('laporan')">📈 Laporan</a>
    <a href="/admin/logout">🔓 Logout</a>
</aside>

<div class="toast" id="toast"></div>
<main id="content"></main>

<script>
/* Toggle Sidebar */
$('#toggleNav').click(()=>{
    $('#sidebar').toggleClass('active');
    $('#content').toggleClass('shifted');
});

/* Load Halaman via AJAX */
function loadPage(page) {
    $.get('/admin/ajax/'+page)
     .done(html => $('#content').html(html))
     .fail(()=> showToast('Gagal memuat.', true));
}

/* Toast */
function showToast(msg, isError=false){
    const t = $('#toast');
    t.removeClass().addClass('toast'+(isError?' toast-error':'')).text(msg).fadeIn();
    setTimeout(()=> t.fadeOut(),3000);
}

$(document).ready(()=> loadPage('dashboard'));
</script>
<script src="<?= base_url('js/admin.js') ?>"></script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>
<body>

<header>
    <h1>Autuf Workshop</h1>
    <div class="top-buttons">
        <a href="#" onclick="tampilForm()">📋 Ambil Nomor Antrian</a>
        <a href="#" onclick="tampilLogin()">🔐 Login Admin</a>
    </div>
</header>

<div class="hero">
    <h2>Selamat Datang di Bengkel Kami</h2>
    <p>Kami siap melayani kendaraan Anda dengan profesional.</p>
</div>
<?php
// Tempatkan di awal sebelum HTML galeri dimulai
$judul = [
    1 => 'Tune Up',
    2 => 'BoreUp',
    3 => 'StrokeUp',
    4 => 'Overhaul',
    5 => 'Oil Engine And transmission',
    6 => 'Brake Maintenance',
    7 => 'maintenance Suspension',
    8 => 'Balancing And Spooring'
];

$deskripsi = [
    1 => 'Boost your engine power and efficiency with a complete tune-up service.',
    2 => 'Increase engine capacity for higher performance and acceleration.',
    3 => 'Ensure safety with precision brake inspection and servicing.',
    4 => 'Enhance torque and speed with professional stroke-up modification.',
    5 => 'Restore your engine like new with a thorough overhaul process.',
    6 => 'Keep your engine and gears running smooth with quality oil service.',
    7 => 'Experience a smoother ride with expert suspension care.',
    8 => 'Improve stability and tire life with perfect wheel alignment.'
];
?>

<div class="layanan-wrapper">
    <div class="layanan" id="gallery">
        <?php for ($loop = 0; $loop < 2; $loop++): ?>
            <?php for ($i = 1; $i <= 8; $i++): 
                $jpg = "/servis{$i}.jpg";
                $jpeg = "/servis{$i}.jpeg";
                $img = file_exists(FCPATH . $jpg) ? $jpg : (file_exists(FCPATH . $jpeg) ? $jpeg : null);
                if (!$img) continue;
            ?>
            <div class="layanan-item">
                <img src="<?= base_url($img) ?>" alt="<?= $judul[$i] ?>"
                    onclick="this.classList.add('zoomed')" onmouseleave="this.classList.remove('zoomed')">
                <h3><?= $judul[$i] ?></h3>
               <p class="deskripsi"><?= $deskripsi[$i] ?></p>
            </div>
            <?php endfor; ?>
        <?php endfor; ?>
    </div>
</div>


<!-- Form Antrian -->
<form id="formAntrian" onsubmit="ajaxAntrian(event)" style="display: none;">
<input type="text" name="nama" placeholder="Nama Lengkap" required style="width: 280px">
<input type="text" name="telepon" placeholder="Nomor Telepon" required style="width: 280px">

<div style="display: flex; justify-content: flex-start; gap: 10px; margin-top: 10px; align-items: center;">
<button type="submit">Ambil Antrian</button>
        <button type="button" class="close-btn" onclick="tutupForm()">
            <img src="<?= base_url('back.png') ?>" width="20px" height="20px">
        </button>
    </div>
    
    <div class="loading" id="loadingAnim" style="display: none;">
        <?php for($b=1;$b<=7;$b++): ?><div class="bar"></div><?php endfor; ?>
    </div>
</form>

<!-- Form Login Admin -->
<form id="formLogin" onsubmit="ajaxLogin(event)" style="display: none;">
<input type="text" name="email" placeholder="Email" required style="width: 280px">
<input type="password" name="password" placeholder="Password" required style="width: 280px">
<div style="display: flex; justify-content: flex-start; gap: 10px; margin-top: 10px; align-items: center;">
<button type="submit">Login</button>
<button type="button" class="close-btn" onclick="tutupForm()">
            <img src="<?= base_url('back.png') ?>" width="20px" height="20px">
        </button>
    </div>
    
    <div class="loading" id="loadingLogin" style="display: none;">
        <?php for($b=1;$b<=7;$b++): ?><div class="bar"></div><?php endfor; ?>
    </div>
</form>

<div class="toast" id="toast"></div>

<div class="info">
    <h3>📍 Alamat</h3>
    <p>Jl. Mekar Jaya No.10, Kota Jakarta</p>
    <h3>📞 Contact Us</h3>
    <p>0811-0000-2211 | Autuff@gmail.com</p>
    <h3>ℹ️ About</h3>
    <p>Kami menyediakan layanan servis kendaraan yang lengkap dan terpercaya, mencakup motor dan mobil. 
    Fokus kami adalah memberikan hasil terbaik dengan dukungan teknisi profesional, peralatan modern, dan sistem layanan berbasis digital.
    Fitur unggulan seperti antrian online, galeri servis, serta penjadwalan terintegrasi menjadikan pengalaman Anda lebih praktis dan efisien.
    Setiap proses servis dilakukan secara transparan, demi kenyamanan dan kepuasan pelanggan.</p>
</div>

<script>
    
// AUTO SCROLL & LOOPING
document.addEventListener('DOMContentLoaded', () => {
    const gallery = document.getElementById('gallery');
    if (gallery) {
        let speed = 1;
        function autoScroll() {
    const scrollAmount = 1;
    setInterval(() => {
        gallery.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        if (gallery.scrollLeft + gallery.clientWidth >= gallery.scrollWidth) {
            gallery.scrollTo({ left: 0, behavior: 'smooth' });
        }
    }, 20);
}
        autoScroll();
    }
});

// Show/hide forms
function tampilForm() {
    document.getElementById('formAntrian').style.display = 'block';
    document.getElementById('formLogin').style.display = 'none';
}
function tampilLogin() {
    document.getElementById('formLogin').style.display = 'block';
    document.getElementById('formAntrian').style.display = 'none';
}

function tutupForm() {
    document.getElementById('formAntrian').style.display = 'none';
}

function tutupLogin() {
    document.getElementById('formLogin').style.display = 'none';
}

// Toast notification
function showToast(msg, isError = false) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className = isError ? 'toast toast-error' : 'toast';
    t.style.display = 'block';
    setTimeout(() => t.style.display = 'none', 3000);
}

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector('#formLogin');
    const antrianForm = document.querySelector('#formAntrian');

    if (loginForm) {
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(loginForm);
            const response = await fetch('/admin/login-process', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const result = await response.json();
            if (result.success) {
                alert(result.success);
                window.location.href = '/admin/dashboard';
            } else {
                alert(result.error || 'Silahkan coba lagi.');
            }
        });
    }

    if (antrianForm) {
        antrianForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(antrianForm);
            const response = await fetch('/pelanggan/submit-antrian', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const result = await response.json();
            if (result.success) {
                alert(result.success);
                antrianForm.reset();
            } else {
                alert(result.error || 'Silahkan coba lagi.');
            }
        });
    }
});
</script>

</body>
</html>

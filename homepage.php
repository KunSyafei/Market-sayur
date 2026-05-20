<?php
session_start();

// Koneksi Database
$conn = mysqli_connect("localhost", "root", "", "nanti dibuat bjshjkd");
$result = mysqli_query($conn, "SELECT * FROM tabel_buah");

// Cek status login
$isLogin = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Marketplace Buah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === VARIABEL WARNA === */
:root {
    --hijau-utama: #4caf50;
    --hijau-muda: #a8d5a2;
    --hijau-terang: #d4edda;
    --hijau-gelap: #2e7d32;
    --hijau-accent: #81c784;
    --putih: #ffffff;
    --abu-terang: #f1f8f2;
    --teks-gelap: #1b3a1e;
    --teks-abu: #5a7a5c;
    --bayangan: rgba(76, 175, 80, 0.15);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--abu-terang);
    background-image:
        radial-gradient(circle at 10% 20%, rgba(168, 213, 162, 0.3) 0%, transparent 40%),
        radial-gradient(circle at 90% 80%, rgba(129, 199, 132, 0.25) 0%, transparent 40%);
    min-height: 100vh;
    color: var(--teks-gelap);
}

/* === TOPBAR === */
.topbar {
    background: linear-gradient(135deg, var(--hijau-gelap) 0%, var(--hijau-utama) 100%);
    color: var(--putih);
    padding: 16px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 20px rgba(46, 125, 50, 0.35);
    position: sticky;
    top: 0;
    z-index: 100;
}

.topbar-title {
    font-size: 1.4rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

.topbar a {
    color: var(--putih);
    text-decoration: none;
    background: rgba(255, 255, 255, 0.2);
    padding: 7px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.875rem;
    border: 1.5px solid rgba(255, 255, 255, 0.4);
    transition: all 0.25s ease;
    backdrop-filter: blur(4px);
}

.topbar a:hover {
    background: var(--putih);
    color: var(--hijau-gelap);
    border-color: var(--putih);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.topbar span {
    font-size: 0.9rem;
    opacity: 0.9;
}

/* === JUDUL === */
.judul {
    text-align: center;
    margin: 40px 0 8px;
    font-size: 1.85rem;
    font-weight: 700;
    color: var(--hijau-gelap);
    letter-spacing: -0.3px;
}

.judul::after {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, var(--hijau-utama), var(--hijau-muda));
    margin: 10px auto 0;
    border-radius: 4px;
}

/* === GRID PRODUK === */
.market-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 24px;
    padding: 32px 40px 60px;
    max-width: 1280px;
    margin: 0 auto;
}

/* === CARD === */
.market-card {
    background: var(--putih);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 4px 20px var(--bayangan);
    border: 1.5px solid rgba(168, 213, 162, 0.4);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    animation: fadeUp 0.5s ease both;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

.market-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 32px rgba(46, 125, 50, 0.2);
}

.market-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-bottom: 3px solid var(--hijau-terang);
    transition: transform 0.4s ease;
}

.market-card:hover img {
    transform: scale(1.04);
}

/* === ISI CARD === */
.market-body {
    padding: 16px 18px 20px;
}

.market-body h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--teks-gelap);
    margin-bottom: 10px;
}

.market-body p {
    font-size: 0.82rem;
    margin-bottom: 5px;
    color: var(--teks-abu);
    display: flex;
    align-items: center;
    gap: 5px;
}

.stok::before    { content: '📦'; }
.asal::before    { content: '📍'; }
.kematangan::before { content: '🌿'; }

/* === BADGE KEMATANGAN === */
.kematangan {
    display: inline-block !important;
    background: var(--hijau-terang);
    color: var(--hijau-gelap) !important;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.78rem !important;
    margin-top: 4px;
}

/* === TOMBOL === */
.btn-beli {
    margin-top: 14px;
    width: 100%;
    padding: 10px;
    background: linear-gradient(135deg, var(--hijau-utama), var(--hijau-gelap));
    color: var(--putih);
    border: none;
    border-radius: 10px;
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s ease;
    letter-spacing: 0.3px;
}

.btn-beli:hover {
    background: linear-gradient(135deg, var(--hijau-gelap), #1b5e20);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(46, 125, 50, 0.35);
}

.btn-beli:active {
    transform: translateY(0);
}

/* === RESPONSIF === */
@media (max-width: 600px) {
    .topbar { padding: 14px 20px; }
    .topbar-title { font-size: 1.1rem; }
    .market-container { padding: 20px 16px 40px; gap: 16px; }
    .judul { font-size: 1.4rem; }
}
    </style>
</head>

<body>

<!-- ===== TOPBAR ===== -->
<div class="topbar">
    <div class="topbar-title">🍏 Marketplace Buah Segar</div>

    <div>
        <?php if ($isLogin): ?>
            <span style="margin-right:10px;">Halo, <?= htmlspecialchars($_SESSION['user']); ?></span>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
</div>

<h2 class="judul">Daftar Buah Tersedia</h2>

<div class="market-container">
<?php while($row = mysqli_fetch_assoc($result)) : ?>
    
    <div class="market-card">
        <img src="image/<?= !empty($row['gambar']) ? htmlspecialchars($row['gambar']) : 'default.jpg'; ?>" 
             alt="<?= htmlspecialchars($row['nama_buah']); ?>">
        
        <div class="market-body">
            <h3><?= htmlspecialchars($row['nama_buah']); ?></h3>
            <p class="stok">Stok: <?= htmlspecialchars($row['stok_kg']); ?> kg</p>
            <p class="asal">Asal: <?= htmlspecialchars($row['asal_sumber']); ?></p>
            <p class="kematangan"><?= htmlspecialchars($row['tingkat_kematangan']); ?></p>

            <button class="btn-beli">Lihat Detail</button>
        </div>
    </div>

<?php endwhile; ?>
</div>

</body>
</html>

<?php
session_start();

// Cek login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['user'];
$page = $_GET['page'] ?? 'home';
?>
<?php 
require 'function.php';
$tabel_buah = mysqli_query($conn,"SELECT * FROM tabel_buah" );
if (isset($_POST["submit"])) {
    if (tambah($_POST)> 0) {
        # code...
    echo "
    <script>
    alert('data BERHASIL');
    document.location.href = 'welcome.php';
    </script>";
    }else {
         echo  "
    <script>
    alert('data ');
    document.location.href = 'welcome.php';
    </script>";
    }
}

?>

<!DOCTYPE html>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
 
<html>
<head>
    <title>welcome</title>
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

/* === KONTEN UTAMA === */
.content {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 24px 60px;
}

.content > h2:first-child {
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--hijau-gelap);
    margin-bottom: 6px;
}

.content > h3 {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--teks-abu);
    margin-bottom: 24px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--hijau-terang);
}

/* === FORM TAMBAH BUAH === */
.form-container {
    background: var(--putih);
    border-radius: 18px;
    padding: 28px 32px;
    margin-bottom: 40px;
    box-shadow: 0 4px 20px var(--bayangan);
    border: 1.5px solid rgba(168, 213, 162, 0.4);
}

.form-container h4 {
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--hijau-gelap);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--hijau-terang);
}

.form-container form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px 20px;
    align-items: start;
}

/* Pasangkan label + input dalam wrapper */
.form-container label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--teks-abu);
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

.form-container input[type="text"],
.form-container input[type="number"],
.form-container input[type="file"],
.form-container select {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid var(--hijau-muda);
    border-radius: 10px;
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    color: var(--teks-gelap);
    background: var(--abu-terang);
    transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
}

.form-container input:focus,
.form-container select:focus {
    border-color: var(--hijau-utama);
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.15);
    background: var(--putih);
}

.form-container select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%234caf50' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
}

.form-container button[type="submit"] {
    grid-column: 1 / -1;
    margin-top: 6px;
    padding: 12px;
    background: linear-gradient(135deg, var(--hijau-utama), var(--hijau-gelap));
    color: var(--putih);
    border: none;
    border-radius: 10px;
    font-family: 'Poppins', sans-serif;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s ease;
    letter-spacing: 0.3px;
}

.form-container button[type="submit"]:hover {
    background: linear-gradient(135deg, var(--hijau-gelap), #1b5e20);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(46, 125, 50, 0.35);
}

/* === JUDUL TABEL === */
.content > h2:last-of-type {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--hijau-gelap);
    margin-bottom: 16px;
}

.content > h2:last-of-type::after {
    content: '';
    display: block;
    width: 48px;
    height: 4px;
    background: linear-gradient(90deg, var(--hijau-utama), var(--hijau-muda));
    margin-top: 8px;
    border-radius: 4px;
}

/* === TABEL === */
table {
    width: 100%;
    border-collapse: collapse;
    background: var(--putih);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px var(--bayangan);
    border: none !important;
}

table th {
    background: linear-gradient(135deg, var(--hijau-gelap), var(--hijau-utama));
    color: var(--putih);
    padding: 14px 16px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: left;
    border: none !important;
}

table td {
    padding: 12px 16px;
    font-size: 0.875rem;
    color: var(--teks-gelap);
    border-bottom: 1px solid var(--hijau-terang) !important;
    border-left: none !important;
    border-right: none !important;
    border-top: none !important;
    vertical-align: middle;
}

table tr:last-child td {
    border-bottom: none !important;
}

table tr:hover td {
    background-color: rgba(212, 237, 218, 0.35);
}

/* === GAMBAR DI TABEL === */
table td img {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid var(--hijau-muda);
}

/* === TOMBOL AKSI === */
table td a {
    display: inline-block;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    margin-right: 5px;
}

table td a[href*="update"] {
    background: var(--hijau-terang);
    color: var(--hijau-gelap);
    border: 1.5px solid var(--hijau-accent);
}

table td a[href*="update"]:hover {
    background: var(--hijau-accent);
    color: var(--putih);
    transform: translateY(-1px);
}

table td a[href*="hapus"] {
    background: #fdecea;
    color: #c0392b;
    border: 1.5px solid #f5c6cb;
}

table td a[href*="hapus"]:hover {
    background: #c0392b;
    color: var(--putih);
    transform: translateY(-1px);
}

/* === LOGOUT === */
.logout-btn {
    display: inline-block;
    margin-top: 30px;
    padding: 10px 28px;
    background: transparent;
    color: var(--hijau-gelap);
    border: 2px solid var(--hijau-utama);
    border-radius: 25px;
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
}

.logout-btn:hover {
    background: linear-gradient(135deg, var(--hijau-utama), var(--hijau-gelap));
    color: var(--putih);
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(46, 125, 50, 0.3);
}

/* === RESPONSIF === */
@media (max-width: 700px) {
    .form-container form {
        grid-template-columns: 1fr;
    }
    .content {
        padding: 0 14px 40px;
    }
    table th, table td {
        padding: 10px 10px;
        font-size: 0.78rem;
    }
}

    
    </style>
</head>
<body>
   
		
		<!--saya kurang tau mengenai case break, tapi dari pengalaman saya menggunakannnya case break seperti alternatif membuat file baru, jadi kita dapat membuat banyak halaman hanya dengan 1 file  -->
	<div class="content">
		<h2 >Selamat datang, <?php echo htmlspecialchars($username); ?>!</h2>
        <?php
       
                $conn = mysqli_connect("localhost", "root", "", "nanti dibuat bjshjkd");

$result = mysqli_query($conn, "SELECT * FROM tabel_buah");

// while ($row = mysqli_fetch_assoc($result)) {
//     echo $row["nama"] . "<br>";}
                

           ?>
                <h3>Laporan Buah</h3>
              
     <div class="form-container">
<h4>Tambah Buah Baru</h4>
<form action="" method="post" enctype="multipart/form-data">

    <div>
        <label for="nama_buah">Nama:</label>
        <input type="text" id="nama_buah" name="nama_buah" required>
    </div>

    <div>
        <label for="stok_kg">Stok (kg):</label>
        <input type="number" id="stok_kg" name="stok_kg" required>
    </div>

    <div>
        <label for="tingkat_kematangan">Tingkat Kematangan:</label>
        <select id="tingkat_kematangan" name="tingkat_kematangan" required>
            <option value="">Pilih Tingkat Kematangan</option>
            <option value="Mentah">Mentah</option>
            <option value="Matang">Setengah Matang</option>
            <option value="Terlalu Matang">Terlalu Matang</option>
        </select>
    </div>

    <div>
        <label for="asal_sumber">Asal Sumber:</label>
        <input type="text" id="asal_sumber" name="asal_sumber" required>
    </div>

    <div style="grid-column: 1 / -1;">
        <label for="gambar">Gambar Profil:</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">
    </div>

    <button type="submit" name="submit" style="grid-column: 1 / -1;">Masukkan</button>

</form>
</div>
               <h2>Daftar Buah
               </h2>
<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>id.</th>
        <th>nama</th>
        <th>stok_kg</th>
        <th>tingkat_kematangan</th>
        <th>asal_sumber</th>
        <th>gambar</th>
        <th>aksi</th> 
    </tr>

<?php
$i = 1;
$tabel_buah = isset($tabel_buah) ? $tabel_buah : [];
foreach ($tabel_buah as $row) : ?>
    <tr>
        <td><?= $i; ?></td>
         <td><?= htmlspecialchars($row['nama_buah']); ?></td>
       <td><?= htmlspecialchars($row['stok_kg']); ?></td>
        <td><?= htmlspecialchars($row['tingkat_kematangan']); ?></td>
         <td><?= htmlspecialchars($row['asal_sumber']); ?></td>
       
               <td>
           <img src="image/<?= !empty($row['gambar']) ? htmlspecialchars($row['gambar']) : 'default.jpg'; ?>">

        </td>
         <td>
            <a href="update.php?id=<?= $row['id']; ?>">ubah</a>
            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">hapus</a>
        </td>
        
         
    </tr>
    
<?php $i++; endforeach; ?>
</table>
  <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
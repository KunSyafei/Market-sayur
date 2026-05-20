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
   <link rel="stylesheet" href="porto.css">
<html>
<head>
    <title>welcome</title>
    <style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    display: flex;
    min-height: 100vh;
}

/* ===== SIDEBAR ===== */
.sidebar {
    width: 220px;
    background: linear-gradient(180deg, #1e8449, #2ecc71);
    color: white;
    padding: 20px;
    flex-shrink: 0;
}

.sidebar h2 {
    text-align: center;
}

.sidebar a {
    display: block;
    color: white;
    padding: 10px;
    text-decoration: none;
    border-radius: 8px;
    margin-bottom: 5px;
}

.sidebar a:hover {
    background-color: rgba(255,255,255,0.2);
}

/* ===== CONTENT ===== */
.content {
    flex: 1;
    padding: 25px;
    background-color: #f4fff6;
    overflow-x: auto;
}

/* ===== FORM ===== */
.form-container {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    margin-bottom: 30px;
}

form input,
form select {
    width: 100%;
    padding: 10px;
    margin: 8px 0 15px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    background-color: #2ecc71;
    border: none;
    padding: 10px 15px;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background-color: #27ae60;
}

/* ===== TABLE ===== */
.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
}

table th {
    background-color: #2ecc71;
    color: white;
    padding: 12px;
}

table td {
    padding: 10px;
    text-align: center;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* ===== LOGOUT ===== */
.logout-btn {
    display: inline-block;
    background-color: #145a32;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
    margin-bottom: 20px;
}

.logout-btn:hover {
    background-color: #e74c3c;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    body {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        text-align: center;
    }

    .content {
        padding: 15px;
    }

    table th, table td {
        font-size: 12px;
        padding: 8px;
    }

    img {
        width: 40px;
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
                <a href="logout.php" class="logout-btn">Logout</a>
     <div class="form-container">
<h4>Tambah Buah Baru</h4>
<form action="" method="post" enctype="multipart/form-data">
<label for="nama">Nama:</label>
<input type="text" id="nama" name="nama" required>
<label for="stok">Stok(kg):</label>
<input type="number" id="stok" name="stok" required>
<select id="tingkat_kematangan" name="tingkat_kematangan" required>
<option value="">Pilih Tingkat Kematangan</option>
<option value="Mentah">Mentah</option>
<option value="Matang">Setengah Matang</option>
<option value="Terlalu Matang">Terlalu Matang</option>
</select>
<label for="jurusan">asal_sumber:</label>
<input type="text" id="asal_sumber" name="asal_sumber" required>


<label for="gambar">Gambar Profil:</label>
<input type="file" id="gambar" name="gambar" accept="image/*">
<button type="submit" name="submit">Masukkan</button>
</form>
</div class="table-wrapper">
               <h2>Daftar Buah
               </h2>
<table border="1" cellpadding="10" cellspacing="0" class="table-wrapper">

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
         <td><?= htmlspecialchars($row['nama']); ?></td>
       <td><?= htmlspecialchars($row['stok_kg']); ?></td>
        <td><?= htmlspecialchars($row['tingkat_kematangan']); ?></td>
         <td><?= htmlspecialchars($row['asal_sumber']); ?></td>
       
               <td>
            <img src="image/<?= htmlspecialchars($row['gambar']); ?>" width="50">
        </td>
         <td>
            <a href="update.php?id=<?= $row['id']; ?>">ubah</a>
            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">hapus</a>
        </td>
        
         
    </tr>
<?php $i++; endforeach; ?>
</table>
    </div>
</body>
</html>
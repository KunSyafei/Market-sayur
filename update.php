<?php
require 'function.php';

// ambil data URL
$id = $_GET["id"];

// query data buah berdasarkan id
$ubahDB = query("SELECT * FROM tabel_buah WHERE id = $id")[0];

// mengechek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {

    //mengechek apakah data berhasil di diubah atau tidak
    if( update($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil DIUPDATE!!!');
                document.location.href = 'welcome.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data GAGAL DIUPDATE!!!');
                document.location.href = 'welcome.php';
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html>
    
<head>
    <style>/* === VARIABEL WARNA === */
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
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
}

/* === CARD FORM === */
form {
    background: var(--putih);
    border-radius: 20px;
    padding: 40px 44px;
    width: 100%;
    max-width: 520px;
    box-shadow: 0 8px 32px rgba(46, 125, 50, 0.18);
    border: 1.5px solid rgba(168, 213, 162, 0.45);
    animation: fadeUp 0.5s ease both;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* === JUDUL === */
h1 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--hijau-gelap);
    text-align: center;
    margin-bottom: 6px;
    position: absolute;
    top: 40px;
    left: 50%;
    transform: translateX(-50%);
    white-space: nowrap;
}

/* Judul di dalam card lebih rapi */
form::before {
    content: 'Update Data Buah';
    display: block;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--hijau-gelap);
    margin-bottom: 6px;
    padding-bottom: 14px;
    border-bottom: 2px solid var(--hijau-terang);
    margin-bottom: 24px;
}

/* === LIST JADI GRID === */
ul {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

li {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

/* === LABEL === */
label {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--teks-abu);
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

/* === INPUT === */
input[type="text"],
input[type="number"],
input[type="file"] {
    width: 100%;
    padding: 11px 15px;
    border: 1.5px solid var(--hijau-muda);
    border-radius: 10px;
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    color: var(--teks-gelap);
    background: var(--abu-terang);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
}

input[type="text"]:focus,
input[type="number"]:focus {
    border-color: var(--hijau-utama);
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.15);
    background: var(--putih);
}

input[type="file"] {
    padding: 8px 12px;
    cursor: pointer;
}

/* === PREVIEW GAMBAR === */
img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid var(--hijau-muda);
    margin: 4px 0;
}

/* === TOMBOL SUBMIT === */
button[type="submit"] {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, var(--hijau-utama), var(--hijau-gelap));
    color: var(--putih);
    border: none;
    border-radius: 10px;
    font-family: 'Poppins', sans-serif;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s ease;
    letter-spacing: 0.4px;
    margin-top: 6px;
}

button[type="submit"]:hover {
    background: linear-gradient(135deg, var(--hijau-gelap), #1b5e20);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(46, 125, 50, 0.35);
}

button[type="submit"]:active {
    transform: translateY(0);
}

/* === RESPONSIF === */
@media (max-width: 480px) {
    form {
        padding: 28px 20px;
    }
}</style>
    <title>UPDATE data buah</title>
</head>
<body>
    <h1>UPDATE data buah</h1>
    <form action="" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?= $ubahDB['id']; ?>">
        <ul>
            <li>
                <label for="nama">nama : </label>
                <input type="text" name="nama" required value="<?= $ubahDB['nama_buah']; ?>">
            </li>
            <li>
                <label for="stok">Stok(kg) : </label>
                <input type="number" name="stok" id="stok" required value="<?= $ubahDB['stok_kg']; ?>">
            </li>
            <li>
                <label for="tingkat_kematangan">Tingkat Kematangan : </label>
                <input type="text" name="tingkat_kematangan" id="tingkat_kematangan" required value="<?= $ubahDB['tingkat_kematangan']; ?>">
            </li>
            <li>
                <label for="asal_sumber">Asal Sumber : </label>
                <input type="text" name="asal_sumber" id="asal_sumber" required value="<?= $ubahDB['asal_sumber']; ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <!-- <img width="50" src="image/<?= $ubahDB['gambar']; ?>"> -->
                <input type="file" name="gambar" id="gambar" >
            </li>
            <li>
                <button type="submit" name="submit">UPDATE Data!</button>
            </li>
        </ul>
    </form>
</body>
</html>
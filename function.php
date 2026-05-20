<?php
$conn = mysqli_connect("localhost", "root", "", "nanti dibuat bjshjkd");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    $nama_buah = $data["nama_buah"];
    $stok_kg = $data["stok_kg"];
    $tingkat_kematangan = $data["tingkat_kematangan"];
    $asal_sumber = $data["asal_sumber"];

    // contoh query
    $query = "INSERT INTO tabel_buah VALUES ('', '$nama_buah', '$stok_kg', '$tingkat_kematangan' '$asal_sumber')";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



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


<?php 
session_start();  

// Data dummy pengguna (simulasikan seperti database)
$dummy_admin = [
    'guru' => 'password123',
    'siswa' => 'siswa123',
    'admin' => 'admin'
];

$dummy_users = [
    'user1' => 'pass1',
    'user2' => 'pass2',
    'user3' => 'pass3'
]; // <-- titik koma ditambahkan

// Terima data dari form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi
if (isset($dummy_admin[$username]) && $dummy_admin[$username] === $password) {
    // Login sukses sebagai admin
    $_SESSION['user'] = $username;
    $_SESSION['role'] = 'admin';
    header("Location: welcome.php");
} 
else if (isset($dummy_users[$username]) && $dummy_users[$username] === $password) {
    // Login sukses sebagai user biasa
    $_SESSION['user'] = $username;
    $_SESSION['role'] = 'user';
    header("Location: homepage.php");
} 
else {
    // Login gagal
    header("Location: login.php?error=1");
}

exit;
?>

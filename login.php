<?php
session_start();
if(isset($_SESSION['user'])) {
    header("Location: welcome.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    
    <title>Document</title>
</head>
<body>
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
    display: flex;
    flex-direction: column;
}

/* === NAVBAR === */
.navbar {
    background: linear-gradient(135deg, var(--hijau-gelap) 0%, var(--hijau-utama) 100%);
    padding: 16px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 20px rgba(46, 125, 50, 0.35);
}

.navbar .logo a {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--putih);
    text-decoration: none;
    letter-spacing: 1px;
    text-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

.navbar ul {
    list-style: none;
    display: flex;
    gap: 16px;
}

.navbar ul li a {
    color: var(--putih);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    padding: 7px 18px;
    border-radius: 25px;
    border: 1.5px solid rgba(255,255,255,0.35);
    transition: all 0.25s ease;
}

.navbar ul li a:hover {
    background: var(--putih);
    color: var(--hijau-gelap);
}

/* === FORM LOGIN === */
.container1 {
    background: var(--putih);
    border-radius: 20px;
    padding: 40px 44px;
    width: 100%;
    max-width: 420px;
    margin: auto;
    box-shadow: 0 8px 32px rgba(46, 125, 50, 0.18);
    border: 1.5px solid rgba(168, 213, 162, 0.45);
    animation: fadeUp 0.5s ease both;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}

.container1 h2 {
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--hijau-gelap);
    text-align: center;
    margin-bottom: 6px;
}

.container1 h2::after {
    content: '';
    display: block;
    width: 48px;
    height: 4px;
    background: linear-gradient(90deg, var(--hijau-utama), var(--hijau-muda));
    margin: 10px auto 24px;
    border-radius: 4px;
}

/* === PESAN ERROR === */
.error {
    background: #fdecea;
    color: #c0392b;
    border: 1.5px solid #f5c6cb;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 18px;
    text-align: center;
}

/* === INPUT & TOMBOL === */
.container1 form {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.container1 input[type="text"],
.container1 input[type="password"] {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid var(--hijau-muda);
    border-radius: 10px;
    font-family: 'Poppins', sans-serif;
    font-size: 0.9rem;
    color: var(--teks-gelap);
    background: var(--abu-terang);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
}

.container1 input:focus {
    border-color: var(--hijau-utama);
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.15);
    background: var(--putih);
}

.container1 input::placeholder {
    color: #9ab89c;
}

.container1 button[type="submit"] {
    margin-top: 6px;
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
}

.container1 button[type="submit"]:hover {
    background: linear-gradient(135deg, var(--hijau-gelap), #1b5e20);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(46, 125, 50, 0.35);
}

.container1 button[type="submit"]:active {
    transform: translateY(0);
}

/* === RESPONSIF === */
@media (max-width: 480px) {
    .navbar { padding: 14px 20px; }
    .container1 { padding: 30px 22px; margin: auto 16px; }
}
    </style>
<nav class="navbar">
        <div class="logo">
            <a href="index.html">KUN SYAFEI</a>
        </div>
        <ul >

        </ul>
    </nav>
      
         <div class="container1">
        <h2>Login</h2>
        
        <?php if(isset($_GET['error'])): ?>
            <p class="error">Username atau password salah!</p>
        <?php endif; ?>

        <form action="auth.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
 
  
</body>
</html>
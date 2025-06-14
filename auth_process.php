<?php
session_start();
require 'db_connect.php';

// ===================================
// PROSES REGISTRASI (SIGN UP)
// ===================================
if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Validasi dasar
    if (empty($name) || empty($email) || empty($password)) {
        header("Location: login.php?error=emptyfields");
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: login.php?error=invalidemail");
        exit();
    }

    // Cek apakah email sudah terdaftar
    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        header("Location: login.php?error=emailtaken");
        exit();
    }

    // Hash password untuk keamanan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan user baru ke database
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php?success=registered");
        exit();
    } else {
        header("Location: login.php?error=sqlerror");
        exit();
    }
}

// ===================================
// PROSES LOGIN (SIGN IN)
// ===================================
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=emptyfields");
        exit();
    }

    // Cari user berdasarkan email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan info user di session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php"); // Arahkan ke halaman utama
            exit();
        } else {
            // Password salah
            header("Location: login.php?error=wrongpassword");
            exit();
        }
    } else {
        // User tidak ditemukan
        header("Location: login.php?error=nouser");
        exit();
    }
}

// ===================================
// PROSES LOGOUT
// ===================================
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Jika tidak ada aksi, kembali ke halaman utama
header("Location: index.php");
exit();
?>
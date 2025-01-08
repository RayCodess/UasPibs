<?php
// Mulai sesi untuk menangani login
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "surat_tugas";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die(json_encode(["message" => "Koneksi ke database gagal: " . mysqli_connect_error()]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk memeriksa apakah username ada
    $sql = "SELECT * FROM tbl_login WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Memeriksa kecocokan password
        if ($password === $user['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role']; // Misalnya role bisa 'admin' atau 'user'

            // Redirect berdasarkan role
            if ($user['role'] == 'admin') {
                header("Location: dashboardAdmin.php");
            } else {
                header("Location: dashboard.php");
            }
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}
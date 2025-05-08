<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "database_penjualan";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
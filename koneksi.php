<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "hybe_corp";

// Buat koneksi
$connection = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($connection->connect_error) {
    die("Koneksi gagal: " . $connection->connect_error);
}

// Fungsi untuk mengambil banyak data
function fetchAll($query) {
    global $connection;
    $result = $connection->query($query);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}
?>

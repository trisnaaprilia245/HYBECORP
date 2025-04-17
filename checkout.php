<?php
session_start();

// Validasi keranjang belanja
if (empty($_SESSION['keranjang'])) {
    header('Location: keranjang.php');
    exit;
}

// Hitung total belanja
$total = 0;
$items = $_SESSION['keranjang'];
foreach ($items as $item) {
    $total += $item['harga'] * $item['jumlah'];
}

// Proses checkout hanya jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simpan data transaksi (contoh sederhana)
    $_SESSION['last_transaction'] = [
        'items' => $items,
        'total' => $total,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    // Kosongkan keranjang
    $_SESSION['keranjang'] = [];
    
    // Redirect untuk menghindari resubmit form
    header('Location: checkout_success.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - HYBECORP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .summary-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">HYBECORP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="merchandise.php">Merchandise</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="keranjang.php">Keranjang</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="keranjang.php" class="btn btn-outline-primary position-relative">
                        <i class="bi bi-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= count($_SESSION['keranjang']) ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Form Checkout -->
                <div class="col-md-8">
                    <h2 class="mb-4">Informasi Pembayaran</h2>
                    <form method="POST" action="checkout.php">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="metode" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="metode" name="metode" required>
                                <option value="">Pilih metode...</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cod">COD (Bayar di Tempat)</option>
                                <option value="e-wallet">E-Wallet</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                    </form>
                </div>
                
                <!-- Ringkasan Belanja -->
                <div class="col-md-4">
                    <div class="summary-card">
                        <h4 class="mb-3">Ringkasan Belanja</h4>
                        <ul class="list-group mb-3">
                            <?php foreach ($_SESSION['keranjang'] as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6><?= htmlspecialchars($item['nama']) ?></h6>
                                    <small><?= $item['jumlah'] ?> x Rp<?= number_format($item['harga'], 0, ',', '.') ?></small>
                                </div>
                                <span>Rp<?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total</span>
                            <span>Rp<?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 bg-light mt-5">
        <div class="container">
            <p>&copy; <?= date('Y') ?> HYBECORP. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();

// Redirect jika tidak ada data transaksi
if (!isset($_SESSION['last_transaction'])) {
    header('Location: merchandise.php');
    exit;
}

$transaction = $_SESSION['last_transaction'];
unset($_SESSION['last_transaction']); // Hapus data transaksi setelah ditampilkan
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Berhasil - HYBECORP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-icon {
            font-size: 5rem;
            color: #28a745;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">HYBECORP</a>
        </div>
    </nav>

    <!-- Konten Utama -->
    <section class="py-5 text-center">
        <div class="container">
            <div class="success-icon mb-4">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h2 class="mb-3">Pembayaran Berhasil!</h2>
            <p class="lead">Terima kasih telah berbelanja di HYBECORP</p>
            
            <div class="card mx-auto mt-4" style="max-width: 500px;">
                <div class="card-body text-start">
                    <h5 class="card-title">Detail Pesanan</h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($transaction['items'] as $item): ?>
                        <li class="list-group-item">
                            <?= htmlspecialchars($item['nama']) ?> (<?= $item['jumlah'] ?> x Rp<?= number_format($item['harga'], 0, ',', '.') ?>)
                        </li>
                        <?php endforeach; ?>
                        <li class="list-group-item fw-bold">
                            Total: Rp<?= number_format($transaction['total'], 0, ',', '.') ?>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Waktu transaksi: <?= $transaction['timestamp'] ?></small>
                        </li>
                    </ul>
                </div>
            </div>
            
            <a href="merchandise.php" class="btn btn-primary mt-4">
                <i class="bi bi-arrow-left"></i> Kembali Berbelanja
            </a>
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
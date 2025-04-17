<?php
session_start();

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Tambahkan item ke keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Validasi input
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $harga = filter_input(INPUT_POST, 'harga', FILTER_VALIDATE_INT);
    $jumlah = max(1, filter_input(INPUT_POST, 'jumlah', FILTER_VALIDATE_INT));
    $gambar_url = filter_input(INPUT_POST, 'gambar_url', FILTER_SANITIZE_URL);

    // Pastikan semua data valid
    if ($id && $nama && $harga !== false && $jumlah !== false && $gambar_url) {
        $item = [
            'id' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'gambar_url' => $gambar_url,
        ];

        // Cek jika item sudah ada di keranjang
        $found = false;
        foreach ($_SESSION['keranjang'] as &$existing) {
            if ($existing['id'] === $item['id']) {
                $existing['jumlah'] += $item['jumlah'];
                $found = true;
                break;
            }
        }
        unset($existing);

        if (!$found) {
            $_SESSION['keranjang'][] = $item;
        }
    }

    header('Location: keranjang.php');
    exit;
}

// Hapus item
if (isset($_GET['hapus'])) {
    $hapusId = filter_input(INPUT_GET, 'hapus', FILTER_SANITIZE_STRING);
    if ($hapusId) {
        $_SESSION['keranjang'] = array_values(array_filter($_SESSION['keranjang'], function ($item) use ($hapusId) {
            return $item['id'] !== $hapusId;
        }));
    }
    header('Location: keranjang.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - HYBECORP Merchandise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .navbar-brand {
            font-weight: bold;
        }
        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            margin-top: 40px;
        }
        .cart-badge {
            font-size: 0.6rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">HYBECORP Merchandise</a>
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
                        <a class="nav-link active" href="keranjang.php">Keranjang</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="keranjang.php" class="btn btn-outline-primary position-relative">
                        <i class="bi bi-cart"></i>
                        <?php if (!empty($_SESSION['keranjang'])): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                            <?= array_sum(array_column($_SESSION['keranjang'], 'jumlah')) ?>
                        </span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <section class="py-5">
        <div class="container">
            <h2 class="mb-4">Keranjang Belanja</h2>
            <?php if (empty($_SESSION['keranjang'])): ?>
                <div class="alert alert-info">
                    Keranjang belanja Anda masih kosong.
                    <a href="merchandise.php" class="alert-link">Lihat merchandise</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th class="text-end">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($_SESSION['keranjang'] as $item):
                                $subtotal = $item['harga'] * $item['jumlah'];
                                $total += $subtotal;
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= htmlspecialchars($item['gambar_url']) ?>" alt="<?= htmlspecialchars($item['nama']) ?>" class="product-img me-3">
                                        <?= htmlspecialchars($item['nama']) ?>
                                    </div>
                                </td>
                                <td class="text-end">Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td class="text-center"><?= $item['jumlah'] ?></td>
                                <td class="text-end">Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <a href="?hapus=<?= urlencode($item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="table-active">
                                <th colspan="3" class="text-end">Total</th>
                                <th colspan="2" class="text-end">Rp<?= number_format($total, 0, ',', '.') ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="merchandise.php" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Lanjutkan Belanja
                    </a>
                    <a href="checkout.php" class="btn btn-success">
                        <i class="bi bi-cart-check"></i> Proses Checkout
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; <?= date('Y') ?> HYBECORP Merchandise. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Konfirmasi sebelum menghapus
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
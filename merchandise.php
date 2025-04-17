<?php
session_start();

define('SITE_NAME', 'HYBE CORPORATION');
$pageTitle = "Merchandise";

$merchandise = [
    [
        'id' => 1,
        'nama' => 'BTS Official Lightstick',
        'kategori' => 'Lightstick',
        'deskripsi' => 'Lightstick resmi dari BTS, sempurna untuk konser dan koleksi penggemar.',
        'harga' => 496312,
        'stok' => 5,
        'gambar_url' => 'https://i.pinimg.com/236x/f7/27/fc/f727fca9ddaa44d0f3127370e3972cfb.jpg'
    ],
    [
        'id' => 2,
        'nama' => 'SEVENTEEN Official Lightstick',
        'kategori' => 'Lightstick',
        'deskripsi' => 'Lightstick resmi dari SEVENTEEN, untuk penggemar setia.',
        'harga' => 464617,
        'stok' => 17,
        'gambar_url' => 'https://i.pinimg.com/236x/6c/22/53/6c2253e7b64299852d0cf6207406062a.jpg'
    ],
    [
        'id' => 3,
        'nama' => 'TXT Official Lightstick',
        'kategori' => 'Lightstick',
        'deskripsi' => 'Lightstick resmi dari TXT.',
        'harga' => 546237,
        'stok' => 11,
        'gambar_url' => 'https://i.pinimg.com/474x/9c/82/c3/9c82c39bf54382ce1cbac77c5dd7cbf1.jpg'
    ],
    [
        'id' => 4,
        'nama' => 'BTS - Album Vol. 1',
        'kategori' => 'Album',
        'deskripsi' => 'Album fisik BTS Vol. 1, lengkap dengan photobook & poster.',
        'harga' => 240912,
        'stok' => 32,
        'gambar_url' => 'https://i.pinimg.com/236x/c4/2f/3f/c42f3f9703d0522b331f2d0c13cb9be6.jpg'
    ],
    [
        'id' => 5,
        'nama' => 'SEVENTEEN - Album Vol. 2',
        'kategori' => 'Album',
        'deskripsi' => 'SEVENTEEN Album Volume 2 dengan bonus photocard.',
        'harga' => 278221,
        'stok' => 28,
        'gambar_url' => 'https://i.pinimg.com/736x/6c/53/ca/6c53ca7bb841cc224bb004067e996a90.jpg'
    ],
    [
        'id' => 6,
        'nama' => 'TXT - Album Vol. 2',
        'kategori' => 'Album',
        'deskripsi' => 'TXT Album Volume 2 untuk MOA.',
        'harga' => 233000,
        'stok' => 15,
        'gambar_url' => 'https://i.pinimg.com/236x/ad/40/c3/ad40c3d7d3de6cebef316f1fb7524b87.jpg'
    ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= SITE_NAME ?> | <?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --hybe-red: #ff2e2e;
            --hybe-dark: #121212;
            --hybe-light: #f8f9fa;
        }
        .merch-card {
            border: none;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .merch-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .merch-img {
            height: 250px;
            object-fit: contain;
            background-color: var(--hybe-light);
            padding: 20px;
        }
        .price-tag {
            font-weight: bold;
            color: var(--hybe-red);
        }
        .in-stock { color: green; }
        .low-stock { color: orange; }
        .out-of-stock { color: red; }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="py-5 bg-dark text-white text-center">
    <div class="container">
        <h1 class="display-5">Official Merchandise</h1>
        <p>Shop your favorite HYBE artists merchandise</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <?php foreach ($merchandise as $item): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card merch-card">
                        <img src="<?= htmlspecialchars($item['gambar_url']) ?>" class="card-img-top merch-img" alt="<?= htmlspecialchars($item['nama']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($item['nama']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($item['deskripsi'], 0, 80)) ?>...</p>
                            <div class="d-flex justify-content-between">
                                <span class="price-tag">Rp<?= number_format($item['harga'], 0, ',', '.') ?></span>
                                <span class="<?= 
                                    $item['stok'] > 20 ? 'in-stock' : 
                                    ($item['stok'] > 0 ? 'low-stock' : 'out-of-stock') ?>">
                                    <?= $item['stok'] > 0 ? $item['stok'].' tersedia' : 'Habis' ?>
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <?php if ($item['stok'] > 0): ?>
                                <form method="post" action="keranjang.php">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="nama" value="<?= htmlspecialchars($item['nama']) ?>">
                                    <input type="hidden" name="harga" value="<?= $item['harga'] ?>">
                                    <input type="hidden" name="gambar_url" value="<?= htmlspecialchars($item['gambar_url']) ?>">
                                    <input type="number" name="jumlah" class="form-control mb-2" value="1" min="1" max="<?= $item['stok'] ?>">
                                    <button type="submit" class="btn btn-danger w-100">Tambah ke Keranjang</button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100" disabled>Habis Terjual</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>

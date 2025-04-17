<?php
session_start();
require_once 'koneksi.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Konfigurasi dasar
define('SITE_NAME', 'HYBE CORPORATION');
$pageTitle = "Home";

// Fungsi helper untuk pengecekan login
function isLoggedIn() {
    return isset($_SESSION['user']);
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'admin';
}

function isStaff() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'staff';
}

// Ambil data agensi dan grup dari database
$agencies = [
    [
        'name' => 'BigHit Music',
        'focus' => 'Boy group K-pop global',
        'groups' => [
            [
                'name' => 'BTS',
                'debut' => '2013',
                'status' => 'Active (beberapa member sedang wamil)',
                'image' => 'https://www.am.com.mx/u/fotografias/m/2022/8/27/f776x436-413286_461637_5050.jpg'
            ],
            [
                'name' => 'TOMORROW X TOGETHER (TXT)',
                'debut' => '2019',
                'status' => 'Active',
                'image' => 'https://ibighit.com/txt/images/txt/profile/sanctuary/profile-kv-m.jpg'
            ],
        ]
    ],
    [
        'name' => 'BELIFT LAB',
        'focus' => 'Program survival & idol global',
        'groups' => [
            [
                'name' => 'ENHYPEN',
                'debut' => '2020 (hasil survival show I-LAND)',
                'status' => 'Ative',
                'image' => 'https://asset.inilahbandung.com/uploads/images/2024/10/image_750x_670f7a0772e47.jpg'
            ],
            [
                'name' => 'I\'LL-IT',
                'debut' => '2024 (hasil R U Next?)',
                'status' => 'Active',
                'image' => 'https://newsimg.koreatimes.co.kr/2024/03/25/72235266-de8c-4715-8866-3da4ea84c6d0.jpg'
            ]
        ]
    ],
    [
        'name' => 'PLEDIS Entertainment',
        'focus' => 'Idol group K-pop, termasuk girl group',
        'groups' => [
            [
                'name' => 'SEVENTEEN',
                'debut' => '2015',
                'status' => 'Active',
                'image' => 'https://statik.tempo.co/data/2022/06/15/id_1117803/1117803_720.jpg'
            ],
            [
                'name' => 'FROMIS_9',
                'debut' => '2018',
                'status' => 'inative',
                'image' => 'https://www.allkpop.com/upload/2024/11/content/290846/1732887985-e99to9bxmai-vjf.jpg'
            ],
            [
                'name' => 'TWS',
                'debut' => '2024',
                'status' => 'Active',
                'image' => 'https://static.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/p1/916/2024/01/29/Picsart_24-01-29_14-45-04-496-876746161.jpg'
            ]
        ]
    ],
    [
        'name' => 'SOURCE MUSIC',
        'focus' => 'Girl group HYBE',
        'groups' => [
            [
                'name' => 'LE SSERAFIM',
                'debut' => '2022',
                'status' => 'Aktif',
                'image' => 'https://www.nme.com/wp-content/uploads/2025/03/LE-SSERAFIM-hero-credit-Source-Music@2000x1270-696x442.jpg'
            ]
        ]
    ],
    [
        'name' => 'KOZ Entertainment',
        'focus' => 'Artis dan produser',
        'groups' => [
            [
                'name' => 'BOYNEXTDOOR',
                'debut' => '2023',
                'status' => 'Aktif',
                'image' => 'https://ultimagz.com/wp-content/uploads/boynextdoor-interview-1-750x375.png'
            ]
        ]
    ],
    [
        'name' => 'HYBE Labels Japan',
        'focus' => 'Pasar Jepang dan internasional',
        'groups' => [
            [
                'name' => '&TEAM',
                'debut' => '2022 (hasil program &AUDITION)',
                'status' => 'Aktif',
                'image' => 'https://cdn-images.dzcdn.net/images/artist/e385a5d6ca1e4d6659efc7f17201bdf4/1900x1900-000000-80-0-0.jpg'
            ]
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> | <?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --hybe-red: #ff2e2e;
            --hybe-dark: #121212;
            --hybe-light: #f8f9fa;
            --hybe-card-bg: #ffffff;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--hybe-light);
            color: #333;
        }
        
        .hybe-navbar {
            background-color: var(--hybe-dark);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .hybe-brand {
            font-weight: 700;
            color: var(--hybe-red) !important;
            font-size: 1.8rem;
        }
        
        .nav-link {
            font-weight: 500;
            position: relative;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--hybe-red);
            bottom: 0;
            left: 0;
            transition: width 0.3s;
        }
        
        .nav-link:hover:after,
        .nav-link.active:after {
            width: 100%;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('https://source.unsplash.com/random/1920x1080/?kpop,concert') no-repeat center;
            background-size: cover;
            height: 60vh;
        }
        
        .agency-card {
            background-color: var(--hybe-card-bg);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .agency-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .agency-header {
            background-color: var(--hybe-dark);
            color: white;
            padding: 20px;
        }
        
        .agency-logo {
            max-height: 50px;
            margin-bottom: 15px;
        }
        
        .group-card {
            border-left: 4px solid var(--hybe-red);
            transition: all 0.3s;
        }
        
        .group-card:hover {
            transform: translateX(5px);
        }
        
        .group-img {
            height: 120px;
            width: 120px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .btn-hybe {
            background-color: var(--hybe-red);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-hybe:hover {
            background-color: #e60000;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 46, 46, 0.3);
            color: white;
        }
        
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 4px;
            background: var(--hybe-red);
            bottom: -10px;
            left: 0;
        }
        
        .hybe-footer {
            background-color: var(--hybe-dark);
            color: white;
            padding: 3rem 0;
        }
        
        .agency-focus {
            font-size: 0.9rem;
            color: #aaa;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark hybe-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand hybe-brand" href="index.php">HYBE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="artists.php">Artists</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="merchandise.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isLoggedIn()): ?>
                        <?php if (isAdmin()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin_dashboard.php">
                                    <i class="fas fa-cog me-1"></i> Admin
                                </a>
                            </li>
                        <?php elseif (isStaff()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="staff_dashboard.php">
                                    <i class="fas fa-user-tie me-1"></i> Staff
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-white d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-4">HYBE CORPORATION</h1>
            <p class="lead mb-5 fs-4">WE BELIEVE IN MUSIC</p>
        </div>
    </section>
            
            <?php foreach ($agencies as $agency): ?>
                <div class="agency-card">
                    <div class="agency-header">
                            <div>
                                <h3 class="mb-1"><?= $agency['name'] ?></h3>
                                <p class="agency-focus mb-0"><?= $agency['focus'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="row">
                            <?php foreach ($agency['groups'] as $group): ?>
                                <div class="col-md-6 mb-4">
                                    <div class="group-card p-3 h-100">
                                        <div class="d-flex">
                                            <img src="<?= $group['image'] ?>" alt="<?= $group['name'] ?>" class="group-img me-3">
                                            <div>
                                                <h5 class="mb-2"><?= $group['name'] ?></h5>
                                                <?php if (!empty($group['debut'])): ?>
                                                    <p class="mb-1 small"><strong>Debut:</strong> <?= $group['debut'] ?></p>
                                                <?php endif; ?>
                                                <p class="mb-1 small"><strong>Status:</strong> <?= $group['status'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="hybe-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="hybe-brand mb-3">HYBE CORPORATION</h3>
                    <p>Music and content that connects the world</p>
                    <div class="social-icons">
                            <a href="https://x.com/HYBEOFFICIALtwt?s=09" class="text-white me-3" target="_blank">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            <a href="https://www.instagram.com/hybe.labels.audition?igsh=a3hpN3BqcHMxcDhu" class="text-white me-3" target="_blank">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                            <a href="https://www.youtube.com/@HYBELABELS" class="text-white me-3" target="_blank">
                                <i class="fab fa-youtube fa-lg"></i>
                            </a>
                        </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="artists.php" class="text-white text-decoration-none">Artists</a></li>
                        <li class="mb-2"><a href="merchandise.php" class="text-white text-decoration-none">Shop</a></li>
                        <li class="mb-2"><a href="contact.php" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
            </div>
            <hr class="bg-secondary">
            <div class="text-center pt-3">
                <p>&copy; <?= date('Y') ?> HYBE CORPORATION. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Highlight active nav link
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = location.pathname.split('/').pop();
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
<?php
session_start();
require_once 'koneksi.php';

define('SITE_NAME', 'HYBE CORPORATION');
$pageTitle = "Artists";

// Data artis dibagi per agensi
$artistsByAgency = [
    'BigHit Music' => [
        'focus' => 'Boy group K-pop global',
        'artists' => [
            [
                'id' => 1,
                'name' => 'BTS',
                'debut_date' => '2013-06-13',
                'status' => 'active',
                'description' => 'BTS, also known as Bangtan Boys, is a South Korean boy band formed in Seoul in 2013. The group debuted under BigHit Entertainment and has become a global K-pop sensation.',
                'image_url' => 'https://www.am.com.mx/u/fotografias/m/2022/8/27/f776x436-413286_461637_5050.jpg'
            ],
            [
                'id' => 2,
                'name' => 'TOMORROW X TOGETHER (TXT)',
                'debut_date' => '2019-03-04',
                'status' => 'active',
                'description' => 'TXT (Tomorrow X Together) is a South Korean boy group formed by BigHit Entertainment. They debuted in 2019 and have been gaining attention for their musical versatility.',
                'image_url' => 'https://ibighit.com/txt/images/txt/profile/sanctuary/profile-kv-m.jpg'
            ]
        ]
    ],
    'BELIFT LAB' => [
        'focus' => 'Program survival & idol global',
        'artists' => [
            [
                'id' => 3,
                'name' => 'ENHYPEN',
                'debut_date' => '2020-11-30',
                'status' => 'active',
                'description' => 'ENHYPEN is a South Korean boy group formed through the survival show I-LAND. They debuted under BELIFT LAB in 2020 and quickly gained popularity worldwide.',
                'image_url' => 'https://asset.inilahbandung.com/uploads/images/2024/10/image_750x_670f7a0772e47.jpg'
            ],
            [
                'id' => 4,
                'name' => 'I’LL-IT',
                'debut_date' => '2024-03-25',
                'status' => 'active',
                'description' => 'I\'LL-IT is a  group set to debut in 2024 as the result of the survival show R U Next?.',
                'image_url' => 'https://newsimg.koreatimes.co.kr/2024/03/25/72235266-de8c-4715-8866-3da4ea84c6d0.jpg'
            ]
        ]
    ],
    'PLEDIS Entertainment' => [
        'focus' => 'Idol group K-pop, termasuk girl group',
        'artists' => [
            [
                'id' => 5,
                'name' => 'SEVENTEEN',
                'debut_date' => '2015-05-26',
                'status' => 'active',
                'description' => 'SEVENTEEN is a South Korean boy group formed by PLEDIS Entertainment. They debuted in 2015 and are known for their self-producing talents.',
                'image_url' => 'https://statik.tempo.co/data/2022/06/15/id_1117803/1117803_720.jpg'
            ],
            [
                'id' => 6,
                'name' => 'FROMIS_9',
                'debut_date' => '2018-01-24',
                'status' => 'inactive',
                'description' => 'FROMIS_9 debuted in 2018 under PLEDIS Entertainment. Originally a project group under another agency, they moved to PLEDIS in 2019.',
                'image_url' => 'https://www.allkpop.com/upload/2024/11/content/290846/1732887985-e99to9bxmai-vjf.jpg'
            ],
            [
                'id' => 7,
                'name' => 'TWS',
                'debut_date' => '2024-01-22',
                'status' => 'active',
                'description' => 'TWS is an abbreviation for ‘TWENTY FOUR SEVEN WITH US’. The number 24, which means a day, and the number 7, which means a week, mean ‘every moment’.',
                'image_url' => 'https://static.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/p1/916/2024/01/29/Picsart_24-01-29_14-45-04-496-876746161.jpg'
            ]
        ]
    ],
    'SOURCE MUSIC' => [
        'focus' => 'Awalnya agensi GFRIEND, kini fokus pada girl group HYBE',
        'artists' => [
            [
                'id' => 8,
                'name' => 'LE SSERAFIM',
                'debut_date' => '2022-05-02',
                'status' => 'active',
                'description' => 'LE SSERAFIM is a girl group formed by SOURCE MUSIC in collaboration with HYBE, featuring members from IZ*ONE, including Sakura and Chaewon.',
                'image_url' => 'https://www.nme.com/wp-content/uploads/2025/03/LE-SSERAFIM-hero-credit-Source-Music@2000x1270-696x442.jpg'
            ]
        ]
    ],
    'KOZ Entertainment' => [
        'focus' => 'Didirikan oleh penyanyi ZICO (Block B), kemudian diakuisisi HYBE',
        'artists' => [
            [
                'id' => 9,
                'name' => 'BOYNEXTDOOR',
                'debut_date' => '2023-05-30',
                'status' => 'active',
                'description' => 'BOYNEXTDOOR means ‘boys next door’ and is KOZ’s first boy group consisting of 6 members: Sungho, Liu, Myung Jaehyun, Taesan, Lee Han, and Woonhak.',
                'image_url' => 'https://ultimagz.com/wp-content/uploads/boynextdoor-interview-1-750x375.png'
            ]
        ]
    ],
    'HYBE Labels Japan' => [
        'focus' => 'Fokus pada pasar Jepang dan internasional',
        'artists' => [
            [
                'id' => 10,
                'name' => '&TEAM',
                'debut_date' => '2022-11-07',
                'status' => 'active',
                'description' => '&TEAM is a boy group formed through the &AUDITION program. They debuted in 2022 and focus on the Japanese and international markets.',
                'image_url' => 'https://cdn-images.dzcdn.net/images/artist/e385a5d6ca1e4d6659efc7f17201bdf4/1900x1900-000000-80-0-0.jpg'
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
        /* Reuse styles from index.php */
        :root {
            --hybe-red: #ff2e2e;
            --hybe-dark: #121212;
            --hybe-light: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--hybe-light);
        }
        
        .hybe-navbar {
            background-color: var(--hybe-dark);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .artist-card {
            transition: all 0.3s;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .artist-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .artist-img {
            height: 250px;
            object-fit: cover;
        }
        
        .btn-hybe {
            background-color: var(--hybe-red);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
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
        
        .status-badge {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .active-status {
            background-color: #28a745;
            color: white;
        }
        
        .inactive-status {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar (same as index.php) -->
    <?php include 'navbar.php'; ?>

    <!-- Artists Header -->
    <section class="py-5 bg-dark text-white">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">HYBE Artists</h1>
            <p class="lead">Discover all artists under HYBE labels</p>
        </div>
    </section>

    <!-- Artists Grid -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <?php foreach ($artistsByAgency as $agency => $data): ?>
                    <h2 class="section-title"><?= $agency ?></h2>
                    <p class="lead"><?= $data['focus'] ?></p>
                    <div class="row">
                        <?php foreach ($data['artists'] as $artist): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card artist-card h-100">
                                    <img src="<?= htmlspecialchars($artist['image_url']) ?>" 
                                        class="card-img-top artist-img" 
                                        alt="<?= htmlspecialchars($artist['name']) ?>">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h3 class="card-title mb-0"><?= htmlspecialchars($artist['name']) ?></h3>
                                            <span class="status-badge <?= $artist['status'] === 'active' ? 'active-status' : 'inactive-status' ?>">
                                                <?= ucfirst($artist['status']) ?>
                                            </span>
                                        </div>
                                        <p class="card-text text-muted">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            <?= !empty($artist['debut_date']) ? date('Y', strtotime($artist['debut_date'])) : 'Not announced' ?>
                                        </p>
                                        <p class="card-text"><?= htmlspecialchars(substr($artist['description'], 0, 100)) ?>...</p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                    <a href="artists_detail.php?id=<?= $artist['id'] ?>" class="btn btn-hybe">View Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

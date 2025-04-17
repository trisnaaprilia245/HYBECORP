<?php
// Mulai session jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Konfigurasi dasar
define('SITE_NAME', 'HYBE CORPORATION');
$pageTitle = "Home";

// Fungsi helper login
function isLoggedIn() {
    return isset($_SESSION['user']);
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'admin';
}

function isStaff() {
    return isLoggedIn() && $_SESSION['user']['role'] === 'staff';
}

// Data agensi dan grup HYBE
// $agencies = [
//     [
//         'name' => 'BigHit Music',
//         'logo' => 'https://via.placeholder.com/150x80?text=BigHit',
//         'focus' => 'Boy group K-pop global',
//         'groups' => [
//             [
//                 'name' => 'BTS',
//                 'debut' => '2013',
//                 'status' => 'Aktif (beberapa member sedang wamil)',
//                 'image' => 'https://via.placeholder.com/300x300?text=BTS'
//             ],
//             [
//                 'name' => 'TOMORROW X TOGETHER (TXT)',
//                 'debut' => '2019',
//                 'status' => 'Aktif',
//                 'image' => 'https://via.placeholder.com/300x300?text=TXT'
//             ],
//             [
//                 'name' => 'Trainee/Pre-debut',
//                 'debut' => '',
//                 'status' => 'Tidak diumumkan secara publik',
//                 'image' => 'https://via.placeholder.com/300x300?text=Trainee'
//             ]
//         ]
//     ],
//     [
//         'name' => 'BELIFT LAB',
//         'logo' => 'https://via.placeholder.com/150x80?text=BELIFT',
//         'focus' => 'Program survival & idol global',
//         'groups' => [
//             [
//                 'name' => 'ENHYPEN',
//                 'debut' => '2020 (hasil survival show I-LAND)',
//                 'status' => 'Aktif',
//                 'image' => 'https://via.placeholder.com/300x300?text=ENHYPEN'
//             ],
//             [
//                 'name' => "I'LL-IT",
//                 'debut' => '2024 (hasil R U Next?)',
//                 'status' => 'Debut',
//                 'image' => 'https://via.placeholder.com/300x300?text=ILL-IT'
//             ]
//         ]
//     ],
//     [
//         'name' => 'PLEDIS Entertainment',
//         'logo' => 'https://via.placeholder.com/150x80?text=PLEDIS',
//         'focus' => 'Idol group K-pop, termasuk girl group',
//         'groups' => [
//             [
//                 'name' => 'SEVENTEEN',
//                 'debut' => '2015',
//                 'status' => 'Aktif',
//                 'image' => 'https://via.placeholder.com/300x300?text=SEVENTEEN'
//             ],
//             [
//                 'name' => 'FROMIS_9',
//                 'debut' => '2018',
//                 'status' => 'Aktif',
//                 'image' => 'https://via.placeholder.com/300x300?text=fromis_9'
//             ]
//         ]
//     ],
//     [
//         'name' => 'SOURCE MUSIC',
//         'logo' => 'https://via.placeholder.com/150x80?text=SOURCE',
//         'focus' => 'Girl group HYBE',
//         'groups' => [
//             [
//                 'name' => 'LE SSERAFIM',
//                 'debut' => '2022',
//                 'status' => 'Aktif',
//                 'image' => 'https://via.placeholder.com/300x300?text=LE+SSERAFIM'
//             ]
//         ]
//     ],
//     [
//         'name' => 'ADOR',
//         'logo' => 'https://via.placeholder.com/150x80?text=ADOR',
//         'focus' => 'Konsep Y2K dan musik fresh',
//         'groups' => [
//             [
//                 'name' => 'NewJeans',
//                 'debut' => '2022',
//                 'status' => 'Aktif',
//                 'image' => 'https://via.placeholder.com/300x300?text=NewJeans'
//             ]
//         ]
//     ],
//     [
//         'name' => 'KOZ Entertainment',
//         'logo' => 'https://via.placeholder.com/150x80?text=KOZ',
//         'focus' => 'Artis dan produser',
//         'groups' => [
//             [
//                 'name' => 'ZICO',
//                 'debut' => '',
//                 'status' => 'Solois dan produser',
//                 'image' => 'https://via.placeholder.com/300x300?text=ZICO'
//             ],
//             [
//                 'name' => 'Dvwn',
//                 'debut' => '',
//                 'status' => 'Solois R&B',
//                 'image' => 'https://via.placeholder.com/300x300?text=Dvwn'
//             ]
//         ]
//     ],
//     [
//         'name' => 'HYBE Labels Japan',
//         'logo' => 'https://via.placeholder.com/150x80?text=HYBE+Japan',
//         'focus' => 'Pasar Jepang dan internasional',
//         'groups' => [
//             [
//                 'name' => '&TEAM',
//                 'debut' => '2022 (hasil program &AUDITION)',
//                 'status' => 'Aktif',
//                 'image' => 'https://via.placeholder.com/300x300?text=andTEAM'
//             ]
//         ]
//     ]
// ];
// ?>

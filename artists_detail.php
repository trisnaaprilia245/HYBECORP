<?php
// artists_detail.php
session_start();
require_once 'koneksi.php';

define('SITE_NAME', 'HYBE CORPORATION');

// Get artist ID from URL
$artistId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Data artis (same structure as artists.php)
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
                'image_url' => 'https://www.am.com.mx/u/fotografias/m/2022/8/27/f776x436-413286_461637_5050.jpg',
                'banner_image' => 'https://ibighit.com/bts/images/profile/proof/member/bts-m.jpg',
                'fandom_name' => 'ARMY',
                'members' => [
                    [
                        "name" => "RM",
                        "full_name" => "Kim Namjoon",
                        "position" => "Leader, Rapper",
                        "img_url" => "https://i.pinimg.com/236x/4f/43/94/4f4394eece6be5b7a7708e8560101db1.jpg"
                    ],
                    [
                        "name" => "Jin",
                        "full_name" => "Kim Seokjin",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/236x/fd/29/45/fd294575cb85956388eb66481ec4afd1.jpg"
                    ],
                    [
                        "name" => "SUGA",
                        "full_name" => "Min Yoongi",
                        "position" => "Rapper",
                        "img_url" => "https://i.pinimg.com/736x/b8/98/aa/b898aa670158fc474b3a7da16e49ccf5.jpg"
                    ],
                    [
                        "name" => "J-Hope",
                        "full_name" => "Jung Hoseok",
                        "position" => "Rapper, Dancer",
                        "img_url" => "https://i.pinimg.com/236x/07/18/88/071888361f745c9c1c28f05861e6ed6c.jpg"
                    ],
                    [
                        "name" => "Jimin",
                        "full_name" => "Park Jimin",
                        "position" => "Vocalist, Dancer",
                        "img_url" => "https://i.pinimg.com/236x/b4/14/ca/b414ca177cc1c04b3796df0da82bc6ad.jpg"
                    ],
                    [
                        "name" => "V",
                        "full_name" => "Kim Taehyung",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/736x/9a/af/f1/9aaff12229721910e2861de8fc4a6f83.jpg"
                    ],
                    [
                        "name" => "Jungkook",
                        "full_name" => "Jeon Jungkook",
                        "position" => "Vocalist, Maknae",
                        "img_url" => "https://i.pinimg.com/236x/5c/0e/5b/5c0e5b603829c6bfb4f9bd014db1f97e.jpg"
                    ],
                ]
            ],
            [
                'id' => 2,
                'name' => 'TOMORROW X TOGETHER (TXT)',
                'debut_date' => '2019-03-04',
                'status' => 'active',
                'description' => 'Tomorrow X Together (TXT) is a five-member boy band formed by BigHit Music. They debuted in 2019 and quickly rose to fame with their vibrant style and diverse discography.',
                'image_url' => 'https://ibighit.com/txt/images/txt/profile/sanctuary/profile-kv-m.jpg',
                'banner_image' => 'https://assets.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/2023/04/20/IMG_20230420_052607-1941622573.jpg',
                'fandom_name' => 'MOA',
                'members' => [
                    [
                        "name" => "Soobin",
                        "full_name" => "Choi Soobin",
                        "position" => "Leader, Vocalist",
                        "img_url" => "https://i.pinimg.com/236x/b6/0a/59/b60a5981fbb5011f00df764ea9c65322.jpg"
                    ],
                    [
                        "name" => "Yeonjun",
                        "full_name" => "Choi Yeonjun",
                        "position" => "Rapper, Dancer",
                        "img_url" => "https://i.pinimg.com/236x/c4/ab/65/c4ab657b80211f94af86b080e37f2172.jpg"
                    ],
                    [
                        "name" => "Beomgyu",
                        "full_name" => "Choi Beomgyu",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/236x/b5/7e/77/b57e77953461d316f05e5620ac590fab.jpg"
                    ],
                    [
                        "name" => "Taehyun",
                        "full_name" => "Kang Taehyun",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/736x/16/e2/71/16e2717435fa917ef918baa4a7d7b774.jpg"
                    ],
                    [
                        "name" => "Huening Kai",
                        "full_name" => "Kai Kamal Huening",
                        "position" => "Vocalist, Maknae",
                        "img_url" => "https://i.pinimg.com/236x/a4/6e/3b/a46e3b8c2d79e4c71d4d476ec610f023.jpg"
                    ]
                ]
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
            'image_url' => 'https://asset.inilahbandung.com/uploads/images/2024/10/image_750x_670f7a0772e47.jpg',
            'banner_image' => 'https://static.wixstatic.com/media/5504b5_3662e7f8b9ef49dbb0ab487b169cc5af~mv2.jpg/v1/fill/w_594,h_200,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/5504b5_3662e7f8b9ef49dbb0ab487b169cc5af~mv2.jpg',
            'fandom_name' => 'ENGENE',
            'members' => [
                [
                    "name" => "Jungwon",
                    "full_name" => "Yang Jungwon",
                    "position" => "Leader, Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/5e/7c/75/5e7c7550711ca8757c98e93d24bc2030.jpg"
                ],
                [
                    "name" => "Heeseung",
                    "full_name" => "Lee Heeseung",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/75/2d/53/752d53969492f5869328b1699ed70e05.jpg"
                ],
                [
                    "name" => "Jay",
                    "full_name" => "Jay Park",
                    "position" => "Rapper",
                    "img_url" => "https://i.pinimg.com/236x/41/3c/1b/413c1b653d893f85d7b815b1fd3a0c15.jpg"
                ],
                [
                    "name" => "Jake",
                    "full_name" => "Jake Sim",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/d5/64/ef/d564eff91d1a0d734548ec4476d8bdbc.jpg"
                ],
                [
                    "name" => "Sunghoon",
                    "full_name" => "Park Sunghoon",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/17/89/12/1789124bbc4f34f5d5b72de7b74892ff.jpg"
                ],
                [
                    "name" => "Sunoo",
                    "full_name" => "Kim Sunoo",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/81/1b/9e/811b9e953dab16c364760c122491ec4a.jpg"
                ],
                [
                    "name" => "Ni-Ki",
                    "full_name" => "Nishimura Riki",
                    "position" => "Main Dancer, Maknae",
                    "img_url" => "https://i.pinimg.com/236x/fe/77/2b/fe772b3eec6b89bbb3055bd51d91acef.jpg"
                ]
            ]
        ],
        [
            'id' => 4,
            'name' => 'I’LL-IT',
            'debut_date' => '2024-03-25',
            'status' => 'active',
            'description' => 'I\'LL-IT is a group set to debut in 2024 as the result of the survival show R U Next?.',
            'image_url' => 'https://newsimg.koreatimes.co.kr/2024/03/25/72235266-de8c-4715-8866-3da4ea84c6d0.jpg',
            'banner_image' => 'https://assets.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p3/75/2024/05/03/Illit-lucky-girl-syndrome-poplineid-2900067796.jpg',
            'fandom_name' => 'GLLIT',
            'members' => [
                [
                    "name" => "Yunah",
                    "full_name" => "Lee Yunah",
                    "position" => "Leader, Vocalist",
                    "img_url" => "https://i.pinimg.com/736x/5e/59/c4/5e59c4e5c0d32a2aabbadf34de291843.jpg"
                ],
                [
                    "name" => "Minju",
                    "full_name" => "Lee Minju",
                    "position" => "Rapper, Dancer",
                    "img_url" => "https://i.pinimg.com/474x/e3/ff/f4/e3fff4b6c1fe43d8c71774d7a4f1af7c.jpg"
                ],
                [
                    "name" => "Moka",
                    "full_name" => "Moka Sakamoto",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/46/52/ae/4652aeed0645c22aae597f371fe1d450.jpg"
                ],
                [
                    "name" => "Wonhee",
                    "full_name" => "Kim Wonhee",
                    "position" => "Vocalist, Maknae",
                    "img_url" => "https://i.pinimg.com/236x/f1/45/d0/f145d0d2f846bfcbc0b29cd34141adbf.jpg"
                ],
                [
                    "name" => "Iroha",
                    "full_name" => "Iroha Tasaki",
                    "position" => "Main Dancer",
                    "img_url" => "https://i.pinimg.com/236x/38/fb/17/38fb174bfdcd537bfcca392b5b1ad918.jpg"
                ]   
            ]
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
            'image_url' => 'https://statik.tempo.co/data/2022/06/15/id_1117803/1117803_720.jpg',
            'banner_image' => 'https://i.pinimg.com/736x/ed/13/6f/ed136f77d86b68e4e4aa9b6f6113c40c.jpg',
            'fandom_name' => 'CARAT',
            'members' => [
                [
                    "name" => "S.Coups",
                    "full_name" => "Choi Seungcheol",
                    "position" => "Leader, Rapper",
                    "img_url" => "https://i.pinimg.com/236x/00/31/32/003132e58d370d967b0fc3c341e54d1f.jpg"
                ],
                [
                    "name" => "Jeonghan",
                    "full_name" => "Yoon Jeonghan",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/14/43/5b/14435b65bd113f2175061fe7c225e292.jpg"
                ],
                [
                    "name" => "Joshua",
                    "full_name" => "Joshua Hong",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/86/a6/f5/86a6f5a75e64e440c3c22f45fd23785e.jpg"
                ],
                [
                    "name" => "Jun",
                    "full_name" => "Wen Junhui",
                    "position" => "Dancer, Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/8d/ca/3d/8dca3d88090dbc0ef65b73d1c390cd55.jpg"
                ],
                [
                    "name" => "Hoshi",
                    "full_name" => "Kwon Soonyoung",
                    "position" => "Performance Leader",
                    "img_url" => "https://i.pinimg.com/736x/bd/7b/71/bd7b716800ffb55a177e15660d8f807e.jpg"
                ],
                [
                    "name" => "Wonwoo",
                    "full_name" => "Jeon Wonwoo",
                    "position" => "Rapper",
                    "img_url" => "https://i.pinimg.com/236x/4e/f9/16/4ef916b805e355c3bf057d980bc63c76.jpg"
                ],
                [
                    "name" => "Woozi",
                    "full_name" => "Lee Jihoon",
                    "position" => "Producer, Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/a0/6f/43/a06f430102f6e53bc857acadb8f4932c.jpg"
                ],
                [
                    "name" => "DK",
                    "full_name" => "Lee Seokmin",
                    "position" => "Main Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/14/58/fe/1458fe8fbac44509bccac27b7ea14e79.jpg"
                ],
                [
                    "name" => "Mingyu",
                    "full_name" => "Kim Mingyu",
                    "position" => "Rapper, Visual",
                    "img_url" => "https://i.pinimg.com/236x/e9/b9/94/e9b99491f5f3b1b5958cdb9e83e31de1.jpg"
                ],
                [
                    "name" => "The8",
                    "full_name" => "Xu Minghao",
                    "position" => "Dancer, Vocalist",
                    "img_url" => "https://i.pinimg.com/474x/ea/c2/82/eac2829d3e4043f8cafdd096a83d92db.jpg"
                ],
                [
                    "name" => "Seungkwan",
                    "full_name" => "Boo Seungkwan",
                    "position" => "Main Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/49/03/47/49034745e6170ee4fcf9371d2f350f5b.jpg"
                ],
                [
                    "name" => "Vernon",
                    "full_name" => "Hansol Vernon Chwe",
                    "position" => "Rapper",
                    "img_url" => "https://i.pinimg.com/236x/0d/b2/4c/0db24c55ba7ccab0514e268fd35e373f.jpg"
                ],
                [
                    "name" => "Dino",
                    "full_name" => "Lee Chan",
                    "position" => "Main Dancer, Maknae",
                    "img_url" => "https://i.pinimg.com/236x/65/1e/15/651e15f2b65747411ccddb092a952297.jpg"
                ]
            ]
        ],
        [
            'id' => 6,
            'name' => 'FROMIS_9',
            'debut_date' => '2018-01-24',
            'status' => 'inactive',
            'description' => 'FROMIS_9 debuted in 2018 under PLEDIS Entertainment. Originally a project group under another agency, they moved to PLEDIS in 2019.',
            'image_url' => 'https://www.allkpop.com/upload/2024/11/content/290846/1732887985-e99to9bxmai-vjf.jpg',
            'banner_image' => 'https://asset.kompas.com/crops/cMWdV5Ro9r4s8m0Dmx1KHmy3nfk=/41x0:965x616/1200x800/data/photo/2021/05/20/60a5fbce633ec.jpg',
            'fandom_name' => 'FLOVER',
            'members' => [
                [
                    "name" => "Saerom",
                    "full_name" => "Lee Saerom",
                    "position" => "Leader, Vocalist",
                    "img_url" => "https://i.pinimg.com/474x/48/2e/3b/482e3bd7b209b65332f694a22b3bd53c.jpg"
                ],
                [
                    "name" => "Hayoung",
                    "full_name" => "Song Hayoung",
                    "position" => "Main Vocalist",
                    "img_url" => "https://i.pinimg.com/736x/26/58/ac/2658ac3e1ee7ea93f3432c7246e6dbba.jpg"
                ],
                [
                    "name" => "Jiwon",
                    "full_name" => "Park Jiwon",
                    "position" => "Main Vocalist",
                    "img_url" => "https://i.pinimg.com/736x/86/8d/9c/868d9c5fbcc0a631a4fdec50cf7bcddd.jpg"
                ],
                [
                    "name" => "Jisun",
                    "full_name" => "Roh Jisun",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/474x/c4/58/22/c45822b267ac2346e0d7fa9e67e58a06.jpg"
                ],
                [
                    "name" => "Seoyeon",
                    "full_name" => "Lee Seoyeon",
                    "position" => "Rapper, Dancer",
                    "img_url" => "https://i.pinimg.com/474x/03/44/42/03444230d3d7499e23ff40413658666f.jpg"
                ],
                [
                    "name" => "Chaeyoung",
                    "full_name" => "Lee Chaeyoung",
                    "position" => "Main Dancer",
                    "img_url" => "https://i.pinimg.com/474x/10/43/11/104311f995819ef25412ad4f5babf727.jpg"
                ],
                [
                    "name" => "Nagyung",
                    "full_name" => "Lee Nagyung",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/474x/23/13/f7/2313f7ca3abb74c7a4760fbc8cd6ba8d.jpg"
                ],
                [
                    "name" => "Jiheon",
                    "full_name" => "Baek Jiheon",
                    "position" => "Maknae, Vocalist",
                    "img_url" => "https://i.pinimg.com/474x/9c/5e/85/9c5e85df85ad5b30f2fe70d186918740.jpg"
                ]
            ]
        ],
        [
            'id' => 7,
            'name' => 'TWS',
            'debut_date' => '2024-01-22',
            'status' => 'active',
            'description' => 'TWS is an abbreviation for ‘TWENTY FOUR SEVEN WITH US’. The number 24, which means a day, and the number 7, which means a week, mean ‘every moment’In other words, it implies the meaning of ‘always with TWS’. Through music, they want to become precious friends who transcend time and space and make the ordinary daily lives of the public and fans special..',
            'image_url' => 'https://static.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/p1/916/2024/01/29/Picsart_24-01-29_14-45-04-496-876746161.jpg',
            'banner_image' => 'https://pict.sindonews.net/dyn/850/pena/news/2024/02/22/700/1326483/10-grup-kpop-gen-4-dan-5-yang-cara-pengucapannya-sering-salah-ada-tws-svd.jpg',
            'fandom_name' => '42 (SAI)',
            'members' => [
                [
                    "name" => "Shinyu",
                    "full_name" => "Kim Shinyu",
                    "position" => "Leader, Vocalist",
                    "img_url" => "https://i.pinimg.com/474x/dc/c8/0b/dcc80bea0c3e9e0f9ac76842b5644d43.jpg"
                ],
                [
                    "name" => "Dohoon",
                    "full_name" => "Han Dohoon",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/736x/4d/4a/31/4d4a31e1a4b0cf423eaccfb35e19f277.jpg"
                ],
                [
                    "name" => "Youngjae",
                    "full_name" => "Kim Youngjae",
                    "position" => "Vocalist",
                    "img_url" => "https://i.pinimg.com/236x/05/d6/a4/05d6a48dc2775b8f3651f5ab2f948438.jpg"
                ],
                [
                    "name" => "Hanjin",
                    "full_name" => "Huang Hanjin",
                    "position" => "Rapper",
                    "img_url" => "https://i.pinimg.com/474x/32/fe/84/32fe848d9e3f73c9313e3374b25e7067.jpg"
                ],
                [
                    "name" => "Jihoon",
                    "full_name" => "Kim Jihoon",
                    "position" => "Dancer",
                    "img_url" => "https://i.pinimg.com/474x/d7/92/39/d79239c15d58ad8301ab2856fc0a3df3.jpg"
                ],
                [
                    "name" => "Kyungmin",
                    "full_name" => "Choi Kyungmin",
                    "position" => "Maknae, Vocalist",
                    "img_url" => "https://i.pinimg.com/474x/ae/a0/21/aea021323912ab2b5e1a8df021ba8899.jpg"
                ]
            ]
        ]
    ]
    ],
    'SOURCE MUSIC' => [
        'focus' => 'Girl group K-pop dengan konsep unik',
        'artists' => [
            [
                'id' => 8,
                'name' => 'LE SSERAFIM',
                'debut_date' => '2022-05-02',
                'status' => 'active',
                'description' => 'LE SSERAFIM is a South Korean girl group formed by Source Music and HYBE. Their name is an anagram of "I’m Fearless", reflecting their concept.',
                'image_url' => 'https://www.nme.com/wp-content/uploads/2025/03/LE-SSERAFIM-hero-credit-Source-Music@2000x1270-696x442.jpg',
                'banner_image' => 'https://imgsrv2.voi.id/ykJm1LiFgJQuZUvkCvhESw-_jWF4l7Pwh4nS3J1fKh4/auto/1200/675/sm/1/bG9jYWw6Ly8vcHVibGlzaGVycy80NzIxODUvMjAyNTAzMjcxNjM5LW1haW4uY3JvcHBlZF8xNzQzMDY4Mzc3LmpwZWc.jpg',
                'fandom_name' => 'FEARNOT',
                'members' => [
                    [
                        "name" => "Kim Chaewon",
                        "full_name" => "Kim Chaewon",
                        "position" => "Leader, Vocalist",
                        "img_url" => "https://i.pinimg.com/474x/60/96/fa/6096fad099bc9d63015ae90273346825.jpg"
                    ],
                    [
                        "name" => "Sakura",
                        "full_name" => "Miyawaki Sakura",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/474x/37/b5/f3/37b5f3eee0452d7bd282323702bbe30c.jpg"
                    ],
                    [
                        "name" => "Huh Yunjin",
                        "full_name" => "Huh Yunjin",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/474x/20/0a/01/200a0154b5a79c86db54c9136c718ccc.jpg"
                    ],
                    [
                        "name" => "Kazuha",
                        "full_name" => "Nakamura Kazuha",
                        "position" => "Dancer, Vocalist",
                        "img_url" => "https://i.pinimg.com/474x/62/58/c0/6258c04d34232f46774f673cf1c6cb77.jpg"
                    ],
                    [
                        "name" => "Hong Eunchae",
                        "full_name" => "Hong Eunchae",
                        "position" => "Maknae",
                        "img_url" => "https://i.pinimg.com/736x/4f/d3/26/4fd326fddc4bcc81cb853cd40543baf3.jpg"
                    ]
                ]
            ]
        ]
    ],
    'KOZ Entertainment' => [
        'focus' => 'Hip-hop dan artis solo kreatif',
        'artists' => [
            [
                'id' => 9,
                'name' => 'BOYNEXTDOOR',
                'debut_date' => '2023-05-30',
                'status' => 'active',
                'description' => 'BOYNEXTDOOR is a hip-hop group formed by KOZ Entertainment, consisting of 6 members: Sungho, Liu, Myung Jaehyun, Taesan, Lee Han, and Woonhak.',
                'image_url' => 'https://ultimagz.com/wp-content/uploads/boynextdoor-interview-1-750x375.png',
                'banner_image' => 'https://www.allkpop.com/upload/2024/10/content/030109/web_data/allkpop_1727932723_20241002-boynextdoor.jpg',
                'fandom_name' => 'ONEDOOR',
                'members' => [  
                    [
                        "name" => "Jaehyun",
                        "full_name" => "Myung Jaehyun",
                        "position" => "Leader, Rapper",
                        "img_url" => "https://i.pinimg.com/236x/46/25/6c/46256cc336c1a671e42abaeb831a5169.jpg"
                    ],
                    [
                        "name" => "Sungho",
                        "full_name" => "Park Sungho",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/736x/fa/91/a8/fa91a8e24b99145fbb34493b11633534.jpg"
                    ],
                    [
                        "name" => "Riwoo",
                        "full_name" => "Lee Riwoo",
                        "position" => "Dancer",
                        "img_url" => "https://i.pinimg.com/736x/4c/ff/80/4cff801ee17018673685ffece3683cb1.jpg"
                    ],
                    [
                        "name" => "Taesan",
                        "full_name" => "Han Taesan",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/736x/15/8a/ca/158acae85fbf431eb5e00124bbe7f5a1.jpg"
                    ],
                    [
                        "name" => "Leehan",
                        "full_name" => "Kim Leehan",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/736x/bf/0c/99/bf0c99b94b2715acc53795025d9ad474.jpg"
                    ],
                    [
                        "name" => "Woonhak",
                        "full_name" => "Park Woonhak",
                        "position" => "Maknae, Rapper",
                        "img_url" => "https://i.pinimg.com/474x/fc/ce/12/fcce12a36dd67d6d8f00321be5fb4269.jpg"
                    ]
                ]
            ]
        ]    
    ],
    'HYBE Labels Japan' => [
        'focus' => 'Boy group Jepang & global',
        'artists' => [
            [
                'id' => 10,
                'name' => '&TEAM',
                'debut_date' => '2022-12-07',
                'status' => 'active',
                'description' => '&TEAM is a global boy group under HYBE Labels Japan, formed through the survival show "THE HOWLING".',
                'image_url' => 'https://cdn-images.dzcdn.net/images/artist/e385a5d6ca1e4d6659efc7f17201bdf4/1900x1900-000000-80-0-0.jpg',
                'banner_image' => 'https://static.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/p1/916/2024/05/08/ANDTEAM-1953649895.png',
                'fandom_name' => 'LUNÉ',
                'members' => [
                    [
                        "name" => "EJ",
                        "full_name" => "Byun Eui Joo",
                        "position" => "Leader, Rapper",
                        "img_url" => "https://i.pinimg.com/236x/0c/e8/aa/0ce8aab77826c4717008d1852fc90947.jpg"
                    ],
                    [
                        "name" => "K",
                        "full_name" => "K Nishimura",
                        "position" => "Dancer, Vocalist",
                        "img_url" => "https://i.pinimg.com/236x/05/16/5e/05165e323fbb76f5455924b685a3a715.jpg"
                    ],
                    [
                        "name" => "Fuma",
                        "full_name" => "Murata Fuma",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/236x/b1/0f/c7/b10fc73344a287c42281033fe1b2b87d.jpg"
                    ],
                    [
                        "name" => "Nicholas",
                        "full_name" => "Wang Yixiang",
                        "position" => "Rapper",
                        "img_url" => "https://i.pinimg.com/474x/62/fd/56/62fd56cd62b04be019a5c0ab2924e021.jpg"
                    ],
                    [
                        "name" => "Yuma",
                        "full_name" => "Yuma Nakayama",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/236x/b5/32/36/b53236cdbac2c3b7a81f2bca0f478dc2.jpg"
                    ],
                    [
                        "name" => "Jo",
                        "full_name" => "Jo Takashi",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/474x/f7/e1/92/f7e192430f0ef5f4ea79797bca029ff8.jpg"
                    ],
                    [
                        "name" => "Harua",
                        "full_name" => "Harua Shigeta",
                        "position" => "Vocalist",
                        "img_url" => "https://i.pinimg.com/474x/fa/3c/1b/fa3c1b823938d56c565abd8edd047891.jpg"
                    ],
                    [
                        "name" => "Taki",
                        "full_name" => "Riki Takahashi",
                        "position" => "Dancer",
                        "img_url" => "https://i.pinimg.com/474x/4d/91/f3/4d91f3dada3a11111e6a96bd4912acaf.jpg"
                    ],
                    [
                        "name" => "Maki",
                        "full_name" => "Maki Yamashita",
                        "position" => "Vocalist, Maknae",
                        "img_url" => "https://i.pinimg.com/236x/fa/b8/86/fab8865e9cf731c1a4033c563d05322c.jpg"
                    ]
                ]
            ]
        ]
    ]
];

$artist = null;
$agencyName = '';

foreach ($artistsByAgency as $agency => $data) {
    foreach ($data['artists'] as $a) {
        if (isset($a['id']) && $a['id'] == $artistId) {
            $artist = $a;
            $agencyName = $agency;
            break 2;
        }
    }
}

if (!$artist) {
    header("Location: artists.php");
    exit;
}

$pageTitle = $artist['name'];
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
        }
        
        .artist-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('<?= htmlspecialchars($artist['banner_image'] ?? 'https://via.placeholder.com/1200x400') ?>') center/cover no-repeat;
            height: 400px;
            display: flex;
            align-items: flex-end;
            color: white;
            margin-bottom: 3rem;
            padding: 2rem;
        }
        
        .artist-profile {
            margin-top: -80px;
            position: relative;
            z-index: 2;
        }
        
        .artist-avatar {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .fandom-badge {
            background-color: var(--hybe-red);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-block;
            font-weight: 600;
        }
        
        .info-card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            border: none;
        }
        
        .info-header {
            background-color: var(--hybe-dark);
            color: white;
            padding: 1rem;
            font-weight: bold;
        }
        
        .member-card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            height: 100%;
        }
        
        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .member-img {
            height: 200px;
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
        
        .btn-hybe:hover {
            background-color: #e60000;
            color: white;
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
    <?php include 'navbar.php'; ?>
    
    <!-- Hero Section -->
    <div class="artist-hero">
        <div class="container">
            <h1 class="display-3 fw-bold"><?= htmlspecialchars($artist['name']) ?></h1>
            <p class="lead"><?= htmlspecialchars($agencyName) ?></p>
        </div>
    </div>
    
    <div class="container">
        <!-- Artist Profile -->
        <div class="row artist-profile">
            <div class="col-md-2">
                <img src="<?= htmlspecialchars($artist['image_url']) ?>" 
                    alt="<?= htmlspecialchars($artist['name']) ?>" class="artist-avatar">
            </div>
            <div class="col-md-10 d-flex align-items-end">
                <div>
                    <h2><?= htmlspecialchars($artist['name']) ?></h2>
                    <?php if (!empty($artist['fandom_name'])): ?>
                        <span class="fandom-badge"><?= htmlspecialchars($artist['fandom_name']) ?></span>
                    <?php endif; ?>
                    <p class="mt-2">
                        <span class="status-badge <?= $artist['status'] === 'active' ? 'active-status' : 'inactive-status' ?>">
                            <?= ucfirst($artist['status']) ?>
                        </span>
                        <span class="ms-2">
                            <i class="fas fa-calendar-alt me-1"></i>
                            <?= !empty($artist['debut_date']) ? date('F j, Y', strtotime($artist['debut_date'])) : 'Not announced' ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-8">
                <!-- Artist Information -->
                <div class="info-card">
                    <div class="info-header">
                        <i class="fas fa-info-circle me-2"></i>Artist Information
                    </div>
                    <div class="p-4 bg-white">
                        <h4>About</h4>
                        <p><?= nl2br(htmlspecialchars($artist['description'])) ?></p>
                        
                        <?php if (!empty($artist['members'])): ?>
                        <h4 class="mt-4">Members</h4>
                        <div class="row">
                            <?php foreach ($artist['members'] as $member): ?>
                            <div class="col-6 col-md-4 col-lg-3 mb-3">
                                <div class="member-card">
                                <img src="<?= !empty($member['img_url']) ? htmlspecialchars($member['img_url']) : 'default-member.jpg' ?>" 
                                alt="<?= htmlspecialchars($member['name']) ?>" 
                                class="w-100 member-img">
                                    <div class="p-3">
                                        <h5 class="mb-1"><?= htmlspecialchars($member['name']) ?></h5>
                                        <p class="text-muted small mb-1"><?= htmlspecialchars($member['full_name']) ?></p>
                                        <?php if (!empty($member['position'])): ?>
                                            <p class="text-muted small"><?= htmlspecialchars($member['position']) ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <!-- Quick Facts -->
                <div class="info-card">
                    <div class="info-header">
                        <i class="fas fa-star me-2"></i>Quick Facts
                    </div>
                    <div class="p-4 bg-white">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong><i class="fas fa-building me-2"></i>Label:</strong> 
                                <span class="float-end"><?= htmlspecialchars($agencyName) ?></span>
                            </li>
                            <li class="mb-3">
                                <strong><i class="fas fa-calendar-day me-2"></i>Debut Date:</strong> 
                                <span class="float-end"><?= !empty($artist['debut_date']) ? date('F j, Y', strtotime($artist['debut_date'])) : 'Unknown' ?></span>
                            </li>
                            <?php if (!empty($artist['fandom_name'])): ?>
                            <li class="mb-3">
                                <strong><i class="fas fa-heart me-2"></i>Fandom:</strong> 
                                <span class="float-end"><?= htmlspecialchars($artist['fandom_name']) ?></span>
                            </li>
                            <?php endif; ?>
                            <li class="mb-3">
                                <strong><i class="fas fa-check-circle me-2"></i>Status:</strong> 
                                <span class="float-end status-badge <?= $artist['status'] === 'active' ? 'active-status' : 'inactive-status' ?>">
                                    <?= ucfirst($artist['status']) ?>
                                </span>
                            </li>
                        </ul>
                        
                        <a href="artists.php" class="btn btn-hybe w-100 mt-3">
                            <i class="fas fa-arrow-left me-2"></i>Back to Artists
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
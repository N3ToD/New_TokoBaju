<?php
session_start();
// Data tim bisa disimpan dalam array PHP agar lebih rapi
$team_members = [
    [
        'name' => 'Muhammad Naufal Rizqullah',
        'nim' => '19240974',
        'role' => 'Fron & back-end Developer'
    ],
    [
        'name' => 'Yasir arafat',
        'nim' => '19240920',
        'role' => 'Front-End Developer'
    ],
    [
        'name' => 'Rama bintang',
        'nim' => '19241424',
        'role' => 'Front-End Developer'
    ],
    [
        'name' => 'Muhammad Fauzan',
        'nim' => '19241346',
        'role' => 'Flowchart'
    ],
    [
        'name' => 'Firmansyah',
        'nim' => '19240671',
        'role' => 'Design PPT'
    ],
    [
        'name' => 'Rahmat Hidayat',
        'nim' => '19241038',
        'role' => 'Flowchart'
    ],
    [
        'name' => 'Muhammad Raihan',
        'nim' => '19240486',
        'role' => 'Design PPT'
    ],
    [
        'name' => 'Rahmat Ferdiansyah',
        'nim' => '19241462',
        'role' => 'Proposal'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - NeoUrban</title>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        
        .team-member-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .team-member-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
    <div class="container">
        <img src="assets/img/logo1.png">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span><i id="bar" class="fa-solid fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    
                   
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <i class="fa-solid fa-bag-shopping"></i>
                            <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                               <span class="badge badge-warning"><?= count($_SESSION['cart']) ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth_process.php?action=logout" title="Logout">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">Hi, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
                    </li>

                <?php else: ?>

                    
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" title="Login / Register">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </a>
                    </li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
    </nav>
    <!-- End Navbar -->

    <!-- Konten Halaman About Us -->
    <section id="about-us" class="my-5 py-5">
        <div class="container text-center mt-5 pt-5">
            <h2 class="font-weight-bold">About Our Team</h2>
            <hr class="mx-auto">
            <p>Kami adalah Kelompok 5</p>
        </div>
        <div class="container mt-5">
            <div class="row">
                
                <?php foreach ($team_members as $member): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card text-center border-0 shadow-sm team-member-card h-100">
                        <div class="card-body">
                            
                            <i class="fas fa-user-circle fa-5x text-secondary my-3"></i>
                            <h5 class="card-title mt-2"><?= htmlspecialchars($member['name']) ?></h5>
                            <p class="card-text text-muted"><?= htmlspecialchars($member['nim']) ?></p>
                            <p class="card-text"><strong><?= htmlspecialchars($member['role']) ?></strong></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- End Konten -->

    <!-- Footer -->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <img src="assets/img/logo2.png" alt="Logo Toko Baju"><br><br>
                <p>Official Reseller Since 2016.</p>
                
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase list-unstyled">
                    <li><a href="category/clothes.php">Clothes</a></li>
                    <li><a href="category/pants.php">Pants</a></li>
                    <li><a href="category/shoes.php">Shoes</a></li>
                    <li><a href="product.php">Collections</a></li>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>Jl. Raya No. 123, Jakarta</p>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>+62 123 4567 890</p>
                    <h6 class="text-uppercase">Email</h6>
                    <p>neourban@gmail.com</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Trusted by</h5>

                <p>Nike</p>
                <p>Adidas</p>
                <p>Puma</p>
                <p>Aerostreet</p>
            </div>
        </div>
        <div class="copyright mt-5">
            <div class="row container mx-auto">
            <div class="col-lg-3 col-md-6 col-12">
                <img src="assets/img/payment.png" alt="Payment Methods"s>
            </div>
            <div class="col-lg-4 col-md-6 col-12 text-nowrap">
            <p>Kelompok 5 © 2025. All rights reserved.</p>
            <p>Designed by Naufal Rizqullah</p>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <p>Our Social Media</p>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
            
        </div>
    </footer>

    <!-- Script JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
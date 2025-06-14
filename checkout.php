<?php
session_start();
require 'db_connect.php';

// Proteksi halaman: hanya untuk user yang sudah login dan punya item di keranjang
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$grand_total = 0;
foreach ($_SESSION['cart'] as $item) {
    $grand_total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - NeoUrban</title>
    <!-- Link CSS Bootstrap & FontAwesome (sama seperti halaman lain) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
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
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>

                <?php if (isset($_SESSION['user_id'])): // Cek apakah user sudah login ?>
                    
                    <!-- Muncul jika SUDAH LOGIN -->
                    <li class="nav-item">
                        <a class="nav-link active" href="cart.php">
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

                    <!-- Muncul jika BELUM LOGIN -->
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
    <section id="checkout-form" class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="font-weight-bold">Checkout</h2>
            <hr class="mx-auto">
        </div>
        <div class="container">
            <div class="row">
                <!-- Form Alamat -->
                <div class="col-md-7">
                    <h4>Shipping Details</h4>
                    <form id="checkout-form" action="checkout/order_process.php" method="POST">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your full address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group">
                           <button type="submit" name="place_order" class="btn btn-primary btn-block">Place Order</button>
                        </div>
                    </form>
                </div>

                <!-- Ringkasan Pesanan -->
                <div class="col-md-5">
                    <h4>Order Summary</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td class="text-center"><?= $item['quantity'] ?></td>
                                <td class="text-right">Rp. <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Grand Total</th>
                                <th class="text-right">Rp. <?= number_format($grand_total, 0, ',', '.') ?></th>
                            </tr>
                        </tfoot>
                    </table>
                     <img src="assets/img/payment.png" alt="Payment Methods" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

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
    <!-- End Footer -->
    
    <!-- Script JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
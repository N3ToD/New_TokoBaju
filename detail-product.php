<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db_connect.php';



// Ambil ID produk dari URL, pastikan itu adalah angka
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id <= 0) {
    header("Location: product.php"); // Alihkan jika ID tidak valid
    exit();
}

// Ambil data produk dari database
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

// Jika produk dengan ID tersebut tidak ada, alihkan
if (!$product) {
    die("Produk tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JUDUL HALAMAN DINAMIS -->
    <title><?= htmlspecialchars($product['name']) ?> - Toko Baju</title>

    <!-- Link CSS Anda (tetap sama) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
    <!-- Style css -->
    <style>
        .small-img-group{ display: flex; justify-content: space-between; }
        .small-img-col{ cursor: pointer; flex-basis: 32%; }
        .dproduct select{ display: block; padding: 5px 10px; }
        .dproduct input{ width:50px; height: 40px; padding-left: 10px; font-size: 16px; margin-right: 10px; }
        .dproduct input:focus { outline: none; }
        .buy-btn{ background: coral; opacity: 1; transition: 0.3s all; }
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
            <a class="nav-link active" href="product.php">Product</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
            </li>
            <a class="nav-link " href="cart.php">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
                           <span class="badge badge-warning"><?= count($_SESSION['cart']) ?></span>
                        <?php } ?>
                    </a>
        </div>
    </div>
    </nav>
    <!--End Navbar-->

    <!--Produk Detail (BAGIAN YANG DIUBAH)-->
    <section class="container dproduct my-5 pt-5">
        <div class="row mt-5">
            <div class="col-lg-5 col-md-12 col-12">
                <!-- GAMBAR UTAMA DINAMIS -->
                <img class="img-fluid w-100 pb-1" src="<?= htmlspecialchars($product['image_url']) ?>" id="MainImg">
                
                <!-- GALERI GAMBAR KECIL DINAMIS -->
                <div class="small-img-group">
                    <?php if (!empty($product['image_url_1'])): ?>
                    <div class="small-img-col">
                        <img src="<?= htmlspecialchars($product['image_url_1']) ?>" width="100%" class="small-img">
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($product['image_url_2'])): ?>
                    <div class="small-img-col">
                        <img src="<?= htmlspecialchars($product['image_url_2']) ?>" width="100%" class="small-img">
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($product['image_url_3'])): ?>
                    <div class="small-img-col">
                        <img src="<?= htmlspecialchars($product['image_url_3']) ?>" width="100%" class="small-img">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <h6>Home / Shoes</h6> <!-- Ini bisa dibuat dinamis jika Anda punya tabel kategori -->
                
                <!-- NAMA PRODUK DINAMIS -->
                <h3 class="py-4"><?= htmlspecialchars($product['name']) ?></h3>
                
                <!-- HARGA PRODUK DINAMIS -->
                <h2 class="p-price">Rp. <?= number_format($product['price'], 0, ',', '.') ?></h2>
                
                <!-- FORM UNTUK "ADD TO CART" -->
                <form action="cart_function.php" method="POST">
                    <!-- Input tersembunyi untuk mengirim data produk ke keranjang -->
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
                    <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                    <input type="hidden" name="product_image" value="<?= htmlspecialchars($product['image_url']) ?>">

                    <select class="my-3">
                        <option>Select Size</option>
                        <option>XXL</option>
                        <option>XL</option>
                        <option>L</option>
                        <option>M</option>
                        <option>S</option>
                    </select>
                    
                    <!-- Input kuantitas dengan atribut name dan pembatasan stok -->
                    <input type="number" name="quantity" value="1" min="1" max="<?= $product['stock'] ?>">
                    
                    <!-- Tombol submit dengan atribut name -->
                    <button type="submit" name="add_to_cart" class="buy-btn">Add To Cart</button>
                </form>

                <h5 class="mt-3">Stok Tersedia: <?= $product['stock'] ?></h5>
                
                <!-- DESKRIPSI PRODUK DINAMIS -->
                <h4 class="mt-4">Product Description</h4>
                <span><?= nl2br(htmlspecialchars($product['description'])) ?></span>
            </div>
        </div>
    </section>
    <!--End Produk Detail-->

    <!-- Footer (tetap sama) -->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <img src="assets/img/logo2.png" alt="Logo Toko Baju">
                
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase list-unstyled">
                    <li><a href="#">Clothes</a></li>
                    <li><a href="#">Pants</a></li>
                    <li><a href="#">Shoes</a></li>
                    <li><a href="#">Collections</a></li>
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

    <!-- Script JS (tetap sama) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

    <!-- Script untuk galeri gambar kecil (sudah benar dan akan berfungsi dengan HTML dinamis) -->
    <script>
        var MainImg = document.getElementById("MainImg");
        var smallimg = document.getElementsByClassName("small-img");

        for (let i = 0; i < smallimg.length; i++) {
            smallimg[i].onclick = function() {
                MainImg.src = smallimg[i].src;
            }
        }
    </script>
    
</body>
</html>
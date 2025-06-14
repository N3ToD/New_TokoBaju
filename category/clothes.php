<?php
session_start();
require '../db_connect.php';

$category_name = "Clothes"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $category_name ?> - NeoUrban</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
    <div class="container">
        <img src="../assets/img/logo1.png">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span><i id="bar" class="fa-solid fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../product.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    
                    
                    <li class="nav-item">
                        <a class="nav-link" href="../cart.php">
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
                        <a class="nav-link" href="../login.php" title="Login / Register">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        </a>
                    </li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
    </nav>
    <!-- End Navbar -->
    <!-- produk -->
     <section id="category-products" class="my-5 py-5">
        <div class="container mt-5 py-5">
            <h2 class="font-weight-bold">Category: <?= $category_name ?></h2>
            <hr>
            <p>Find all your favorite <?= strtolower($category_name) ?> here.</p>
        </div>
        <div class="row mx-auto container-fluid">
            <?php
            // Query untuk mengambil produk berdasarkan kategori
            $sql = "SELECT * FROM products WHERE category = ? ORDER BY id DESC";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $category_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                while($product = mysqli_fetch_assoc($result)) {
            ?>
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <!-- Gunakan '../' untuk path halaman detail -->
                <a href="../detail-product.php?id=<?= $product['id'] ?>">
                    <!-- Gunakan '../' untuk path gambar -->
                    <img class="img-fluid mb-3" src="../<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </a>
                <h5 class="p-name"><?= htmlspecialchars($product['name']) ?></h5>
                <h4 class="p-price">Rp. <?= number_format($product['price'], 0, ',', '.') ?></h4>
                <a href="../detail-product.php?id=<?= $product['id'] ?>">
                    <button class="buy-btn">Buy Now</button>
                </a>
            </div>
            <?php
                }
            } else {
                echo "<p class='text-center'>No products found in this category.</p>";
            }
            ?>
        </div>
    </section>
    <!-- Produk End-->
    <!-- Footer -->
    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <img src="../assets/img/logo2.png" alt="Logo Toko Baju"><br><br>
                <p>Official Reseller Since 2016.</p>
                
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase list-unstyled">
                    <li><a href="clothes.php">Clothes</a></li>
                    <li><a href="pants.php">Pants</a></li>
                    <li><a href="shoes.php">Shoes</a></li>
                    <li><a href="../product.php">Collections</a></li>
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
                <img src="../assets/img/payment.png" alt="Payment Methods"s>
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

    <!-- slim -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script></body>
</body>
</html>
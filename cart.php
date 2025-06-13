<?php
session_start();
require 'db_connect.php';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$grand_total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - NeoUrban</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <a class="nav-link" href="index.php">Home</a>
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
            <a class="nav-link active" href="cart.php">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
                           <span class="badge badge-warning"><?= count($_SESSION['cart']) ?></span>
                        <?php } ?>
                    </a>
        </div>
    </div>
    </nav>
    <!-- End Navbar -->
    <!-- Keranjang -->
     <section id="cart" class="'pt-5 mt-5 container">
        <h2 class="fint-weight-bold pt-5">Your Cart</h2>
        <hr>
     </section>

     <section id="cart-container" class="container my-5">
        <form action="cart_function.php" method="POST">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Remove</td>
                        <td>Image</td>
                        <td>Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <?php foreach ($_SESSION['cart'] as $product_id => $item):
                            $subtotal = $item['price'] * $item['quantity'];
                            $grand_total += $subtotal;
                        ?>
                        <tr>
                           <td><a href="cart_function.php?remove=<?= $product_id ?>"><i class="fas fa-trash-alt"></i></a></td>
                            <td><img src="<?= htmlspecialchars($item['image']) ?>"></td>
                            <td><h5><?= htmlspecialchars($item['name']) ?></h5></td>
                            <td><h5 class="p-price">Rp. <?= number_format($item['price'], 0, ',', '.') ?></h5></td>
                            <td><input class="w-25 pl-1" name="quantities[<?= $product_id ?>]" type="number" value="<?= $item['quantity'] ?>" min="1"></td>
                            <td><h5>Rp. <?= number_format($subtotal, 0, ',', '.') ?></h5></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">Your cart is empty.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php if (!empty($_SESSION['cart'])): ?>
            <div class="cart-total my-5">
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" name="update_cart" class="btn btn-dark">Update Cart</button>
                    </div>
                    <div class="col-md-6 text-right">
                        <h3>Total: Rp. <?= number_format($grand_total, 0, ',', '.') ?></h3>
                        <button class="btn btn-primary">Proceed to Checkout</button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </form>
    </section>
    <!-- End Keranjang-->
    <!-- Footer -->
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

    <!-- slim -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script></body>
</body>
</html>
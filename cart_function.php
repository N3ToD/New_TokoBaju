<?php
session_start();

// Inisialisasi keranjang jika belum ada di dalam session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 1. Aksi: Menambahkan produk ke keranjang
if (isset($_POST['add_to_cart'])) {
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    
    if ($product_id && $quantity > 0) {
        // Jika produk sudah ada, tambahkan kuantitasnya
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            // Jika produk baru, tambahkan sebagai item baru
            $_SESSION['cart'][$product_id] = [
                'name'     => $_POST['product_name'],
                'price'    => $_POST['product_price'],
                'image'    => $_POST['product_image'],
                'quantity' => $quantity
            ];
        }
    }
    
    header('Location: cart.php?status=added');
    exit();
}

// 2. Aksi: Menghapus produk dari keranjang
if (isset($_GET['remove'])) {
    $product_id = filter_input(INPUT_GET, 'remove', FILTER_VALIDATE_INT);

    if ($product_id && isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
    
    header('Location: cart.php?status=removed');
    exit();
}

// 3. Aksi: Mengupdate kuantitas di keranjang
 elseif (isset($_POST['update_cart'])) {
    if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
        foreach ($_POST['quantities'] as $product_id => $quantity) {
            $product_id = (int)$product_id;
            $quantity = (int)$quantity;

            if (isset($_SESSION['cart'][$product_id])) {
                if ($quantity > 0) {
                    $_SESSION['cart'][$product_id]['quantity'] = $quantity;
                } else {
                    // Jika kuantitas 0 atau kurang, hapus item
                    unset($_SESSION['cart'][$product_id]);
                }
            }
        }
    }
    
    // Alihkan kembali ke halaman keranjang
    header('Location: cart.php?status=updated');
    exit();

} else {
    // Jika tidak ada aksi yang cocok, alihkan ke halaman utama
    header('Location: index.php');
    exit();
}
?>
<?php
session_start();

// Langkah Debugging: Tampilkan semua data POST yang diterima
echo "<pre>";
var_dump($_POST);
echo "</pre>";

if (isset($_POST['add_to_cart'])) {
    echo "Kondisi 'add_to_cart' terpenuhi. Masuk ke blok if.<br>"; // Pesan debug

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Inisialisasi keranjang jika belum ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $_POST['product_name'],
            'price' => $_POST['product_price'],
            'image' => $_POST['product_image'],
            'quantity' => $quantity
        ];
    }
    
    // Langkah Debugging: Tampilkan isi session SETELAH diubah
    echo "Isi Session['cart'] setelah diupdate:<br>";
    echo "<pre>";
    var_dump($_SESSION['cart']);
    echo "</pre>";

    // Hentikan eksekusi agar tidak redirect dulu
    die("Debugging selesai. Hapus kode debug ini jika sudah berhasil."); 
    
    // header('Location: cart.php?status=added'); // Sementara non-aktifkan redirect
    // exit();

} else {
    die("Kondisi 'add_to_cart' TIDAK terpenuhi. Cek nama tombol submit Anda.");
}

// Fungsi untuk mengupdate kuantitas
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $product_id => $quantity) {
        if (isset($_SESSION['cart'][$product_id])) {
            if ($quantity > 0) {
                $_SESSION['cart'][$product_id]['quantity'] = $quantity;
            } else {
                // Hapus jika kuantitas 0 atau kurang
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }
    // Arahkan kembali ke halaman keranjang
    header('Location: cart.php?status=updated');
    exit();
}
?>
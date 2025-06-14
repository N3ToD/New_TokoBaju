<?php
session_start();
require '../db_connect.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['place_order'])) {
    header("Location: ../index.php");
    exit();
}

mysqli_begin_transaction($conn);

try {
    $user_id = $_SESSION['user_id'];
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $grand_total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $grand_total += $item['price'] * $item['quantity'];
    }

    $sql_order = "INSERT INTO orders (user_id, full_name, address, phone, total_amount) VALUES (?, ?, ?, ?, ?)";
    $stmt_order = mysqli_prepare($conn, $sql_order);
    mysqli_stmt_bind_param($stmt_order, "isssd", $user_id, $full_name, $address, $phone, $grand_total);
    mysqli_stmt_execute($stmt_order);

    $order_id = mysqli_insert_id($conn);

    $sql_items = "INSERT INTO order_items (order_id, product_id, product_name, price, quantity) VALUES (?, ?, ?, ?, ?)";
    $stmt_items = mysqli_prepare($conn, $sql_items);
    
    foreach ($_SESSION['cart'] as $product_id => $item) {
        mysqli_stmt_bind_param($stmt_items, "iisdi", $order_id, $product_id, $item['name'], $item['price'], $item['quantity']);
        mysqli_stmt_execute($stmt_items);
    }
    
    $sql_stock = "UPDATE products SET stock = stock - ? WHERE id = ?";
    $stmt_stock = mysqli_prepare($conn, $sql_stock);

    foreach ($_SESSION['cart'] as $product_id => $item) {
        mysqli_stmt_bind_param($stmt_stock, "ii", $item['quantity'], $product_id);
        mysqli_stmt_execute($stmt_stock);
    }

    mysqli_commit($conn);

    unset($_SESSION['cart']);
    
    $_SESSION['last_order_id'] = $order_id;

    header("Location: order_success.php");
    exit();

} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($conn);
    header("Location: ../checkout.php?error=orderfailed");
    exit();
}
?>
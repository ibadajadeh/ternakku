<?php
session_start();
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Ambil detail produk dari database
    $stmt = $conn->prepare("SELECT id, name, price FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        $item = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity
        ];

        // Cek apakah produk sudah ada di cart
        $found = false;
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $item['id']) {
                $cart_item['quantity'] += $item['quantity'];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = $item;
        }

        header("Location: cart.php");
        exit;
    } else {
        echo "Produk tidak ditemukan.";
    }
} else {
    echo "Permintaan tidak valid.";
}
?>

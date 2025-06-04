<?php
session_start();
include_once('config.php');

// Hapus item jika tombol "Hapus" ditekan
if (isset($_GET['hapus'])) {
    $hapus_id = $_GET['hapus'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $hapus_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    // Re-index array
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f3f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 14px;
            text-align: center;
            border: 1px solid #e0e0e0;
        }
        th {
            background-color: #f7f7f7;
        }
        .btn {
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        .btn-hapus {
            background-color: #e74c3c;
            color: white;
        }
        .btn-hapus:hover {
            background-color: #c0392b;
        }
        .btn-checkout {
            background-color: #27ae60;
            color: white;
            float: right;
            margin-top: 20px;
        }
        .btn-checkout:hover {
            background-color: #1e8449;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
        }
        .empty {
            text-align: center;
            padding: 30px;
            font-size: 18px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛒 Keranjang Belanja</h1>

        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <table>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
            <?php 
            $grand_total = 0;
            foreach ($_SESSION['cart'] as $item): 
                $total = $item['price'] * $item['quantity'];
                $grand_total += $total;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                <td>
                    <a class="btn btn-hapus" href="cart.php?hapus=<?php echo $item['id']; ?>" onclick="return confirm('Hapus item ini dari keranjang?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div class="total">
            <strong>Total: Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></strong>
        </div>
        <a class="btn btn-checkout" href="checkout.php">Lanjut ke Checkout</a>

        <?php else: ?>
            <div class="empty">
                Keranjang Anda kosong 😢<br><br>
                <a href="dashboard.php">Kembali ke Toko</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

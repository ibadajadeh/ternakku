<?php
include_once('config.php');
session_start();

// Redirect jika keranjang kosong
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    echo "<script>alert('Keranjang kosong.'); window.location='cart.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f2f4f8;
            margin: 0;
            padding: 0;
        }
        .checkout-container {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            font-size: 20px;
            color: #444;
            margin-bottom: 15px;
        }
        .cart-summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-summary th, .cart-summary td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: center;
        }
        .cart-summary th {
            background-color: #f5f5f5;
        }
        form input[type="text"],
        form textarea,
        form select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 15px;
        }
        form textarea {
            resize: vertical;
            height: 80px;
        }
        .btn-confirm {
            background-color: #4CAF50;
            color: white;
            padding: 14px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-confirm:hover {
            background-color: #45a049;
        }
        .total-row {
            font-weight: bold;
            background: #fafafa;
        }
        @media (max-width: 768px) {
            .checkout-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h1>🧾 Checkout</h1>

        <div class="section cart-summary">
            <h2>Ringkasan Belanja</h2>
            <table>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
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
                </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="3">Total Keseluruhan</td>
                    <td>Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2>Informasi Pembeli</h2>
            <form action="proses_checkout.php" method="POST">
                <input type="text" name="nama" placeholder="Nama Lengkap" required>
                <textarea name="alamat" placeholder="Alamat Lengkap" required></textarea>
                <input type="text" name="telepon" placeholder="Nomor Telepon" required>
                <select name="metode_pembayaran" required>
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="cod">Cash on Delivery (COD)</option>
                    <option value="qris">QRIS</option>
                </select>
                <button class="btn-confirm" type="submit">Konfirmasi Pesanan</button>
            </form>
        </div>
    </div>
</body>
</html>

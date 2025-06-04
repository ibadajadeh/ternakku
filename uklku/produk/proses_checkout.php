<?php
session_start();
include('config.php');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Validasi input
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $telepon = $conn->real_escape_string($_POST['telepon']);
    $metode = $conn->real_escape_string($_POST['metode_pembayaran']);
    $tanggal = date("Y-m-d H:i:s");
    $total_harga = 0;

    // Hitung total harga
    foreach ($_SESSION['cart'] as $item) {
        $total_harga += $item['price'] * $item['quantity'];
    }

    // Simpan ke tabel orders
    $sql_order = "INSERT INTO orders (nama, alamat, telepon, metode_pembayaran, total, tanggal) 
                  VALUES ('$nama', '$alamat', '$telepon', '$metode', '$total_harga', '$tanggal')";
    
    if ($conn->query($sql_order)) {
        $order_id = $conn->insert_id;

        // Simpan detail produk ke order_items
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['id'];
            $qty = $item['quantity'];
            $price = $item['price'];
            $total = $price * $qty;

            $sql_detail = "INSERT INTO order_items (order_id, product_id, quantity, price, total)
                           VALUES ('$order_id', '$product_id', '$qty', '$price', '$total')";
            $conn->query($sql_detail);
        }

        // Kosongkan keranjang
        unset($_SESSION['cart']);

        // Redirect atau tampilkan halaman sukses
        echo "<script>
                alert('Pesanan berhasil dibuat!');
                window.location.href = 'thank_you.php';
              </script>";
    } else {
        echo "Terjadi kesalahan saat menyimpan pesanan: " . $conn->error;
    }

} else {
    echo "<script>
            alert('Data tidak lengkap atau keranjang kosong!');
            window.location.href = 'cart.php';
          </script>";
}
?>

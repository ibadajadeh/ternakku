<?php
include 'config.php';
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    die("Akses ditolak.");
}

// Ambil data user dan produk untuk dropdown
$users = $conn->query("SELECT id, username FROM users");
$products = $conn->query("SELECT id, name FROM products");

// Handle form submit add or edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = intval($_POST['user_id']);
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = intval($_POST['id']);
        $conn->query("UPDATE orders SET user_id=$user_id, product_id=$product_id, quantity=$quantity WHERE id=$id");
    } else {
        $conn->query("INSERT INTO orders (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)");
    }
    header("Location: pesanan.php");
    exit;
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM orders WHERE id=$id");
    header("Location: pesanan.php");
    exit;
}

// Jika edit, ambil data pesanan
$editOrder = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM orders WHERE id=$id");
    $editOrder = $res->fetch_assoc();
}

// Ambil data pesanan untuk ditampilkan
$orders = $conn->query("SELECT orders.id, users.username, products.name AS product_name, orders.quantity, orders.order_date
                        FROM orders
                        JOIN users ON orders.user_id = users.id
                        JOIN products ON orders.product_id = products.id
                        ORDER BY orders.id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Pesanan</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #007bff; color: white; }
        form { max-width: 500px; margin-bottom: 40px; }
        label { display: block; margin-top: 10px; }
        select, input[type=number] {
            width: 100%; padding: 8px; box-sizing: border-box;
        }
        button { margin-top: 15px; padding: 10px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
        a.button-delete { color: white; background-color: #dc3545; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        a.button-delete:hover { background-color: #c82333; }
        a.button-edit { color: white; background-color: #17a2b8; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        a.button-edit:hover { background-color: #138496; }
             .crud {
  display: flex;
  gap: 12px;
  justify-content: center;
  margin: 20px 0;
  flex-wrap: wrap;
}

.crud button {
  background-color: #4CAF50;
  border: none;
  border-radius: 6px;
  padding: 12px 20px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.crud button:hover {
  background-color: #45a049;
}

.crud button a {
  color: white;
  text-decoration: none;
  font-weight: 600;
  font-size: 16px;
  display: inline-block;
  /* agar link mengisi seluruh button */
  width: 100%;
  height: 100%;
}

.crud button a:focus {
  outline: none;
}
    </style>
</head>
<body>
    <h2>Manajemen Pesanan</h2>

    <form method="post" action="pesanan.php">
        <input type="hidden" name="id" value="<?= $editOrder ? $editOrder['id'] : '' ?>">

        <label>Pengguna:</label>
        <select name="user_id" required>
            <option value="">-- Pilih Pengguna --</option>
            <?php while ($u = $users->fetch_assoc()): ?>
                <option value="<?= $u['id'] ?>" <?= ($editOrder && $editOrder['user_id'] == $u['id']) ? 'selected' : '' ?>><?= htmlspecialchars($u['username']) ?></option>
            <?php endwhile; ?>
        </select>

        <label>Produk:</label>
        <select name="product_id" required>
            <option value="">-- Pilih Produk --</option>
            <?php while ($p = $products->fetch_assoc()): ?>
                <option value="<?= $p['id'] ?>" <?= ($editOrder && $editOrder['product_id'] == $p['id']) ? 'selected' : '' ?>><?= htmlspecialchars($p['name']) ?></option>
            <?php endwhile; ?>
        </select>

        <label>Jumlah:</label>
        <input type="number" name="quantity" required value="<?= $editOrder ? $editOrder['quantity'] : '' ?>">

        <button type="submit"><?= $editOrder ? 'Update Pesanan' : 'Tambah Pesanan' ?></button>
        <?php if ($editOrder): ?>
            <a href="orders.php" style="margin-left:10px;">Batal</a>
        <?php endif; ?>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pengguna</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Tanggal Pesan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $orders->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $row['order_date'] ?></td>
                    <td>
                        <a class="button-edit" href="pesanan.php?edit=<?= $row['id'] ?>">Edit</a>
                        <a class="button-delete" href="pesanan.php?delete=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus pesanan ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="crud">
<button><a href="index.php">User</a></button>
<button><a href="produk.php">Olshop</a></button>
<button><a href="pesanan.php">pemesanan</a></button>
<button><a href="study.php">Artikel</a></button>
<button><a href="kategori.php">Kategori Artikel</a></button>
</div>

</body>
</html>

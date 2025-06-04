<?php
include 'config.php';
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    die("Akses ditolak.");
}

// Handle form submit add or edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = floatval($_POST['price']);

    // Upload gambar
    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = 'uploads/';
        if (!file_exists($targetDir)) mkdir($targetDir);
        $image = basename($_FILES['image']['name']);
        $targetFile = $targetDir . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = intval($_POST['id']);
        if ($image) {
            $conn->query("UPDATE products SET name='$name', description='$description', price=$price, image='$image' WHERE id=$id");
        } else {
            $conn->query("UPDATE products SET name='$name', description='$description', price=$price WHERE id=$id");
        }
    } else {
        $conn->query("INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', $price, '$image')");
    }

    header("Location: produk.php");
    exit;
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM products WHERE id=$id");
    header("Location: produk.php");
    exit;
}

// Ambil data produk untuk ditampilkan
$products = $conn->query("SELECT * FROM products ORDER BY id DESC");

// Jika edit, ambil data produk yang diedit
$editProduct = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM products WHERE id=$id");
    $editProduct = $res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Produk</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #007bff; color: white; }
        form { max-width: 500px; margin-bottom: 40px; }
        label { display: block; margin-top: 10px; }
        input[type=text], textarea, input[type=number], input[type=file] {
            width: 100%; padding: 8px; box-sizing: border-box;
        }
        button { margin-top: 15px; padding: 10px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
        a.button-delete { color: white; background-color: #dc3545; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        a.button-delete:hover { background-color: #c82333; }
        a.button-edit { color: white; background-color: #17a2b8; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        a.button-edit:hover { background-color: #138496; }
        img { max-width: 100px; height: auto; }
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
    <h2>Manajemen Produk</h2>

    <form method="post" action="produk.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $editProduct ? $editProduct['id'] : '' ?>">
        <label>Nama Produk:</label>
        <input type="text" name="name" required value="<?= $editProduct ? htmlspecialchars($editProduct['name']) : '' ?>">

        <label>Deskripsi:</label>
        <textarea name="description"><?= $editProduct ? htmlspecialchars($editProduct['description']) : '' ?></textarea>

        <label>Harga (Rp):</label>
        <input type="number" step="0.01" name="price" required value="<?= $editProduct ? $editProduct['price'] : '' ?>">

        <label>Gambar Produk:</label>
        <input type="file" name="image">

        <?php if ($editProduct && $editProduct['image']): ?>
            <p>Gambar saat ini:</p>
            <img src="uploads/<?= htmlspecialchars($editProduct['image']) ?>" width="100">
        <?php endif; ?>

        <button type="submit"><?= $editProduct ? 'Update Produk' : 'Tambah Produk' ?></button>
        <?php if ($editProduct): ?>
            <a href="produk.php" style="margin-left:10px;">Batal</a>
        <?php endif; ?>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga (Rp)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $products->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td>
                        <?php if ($row['image']): ?>
                            <img src="uploads/<?= htmlspecialchars($row['image']) ?>" width="60">
                        <?php else: ?>
                            <span>-</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td><?= number_format($row['price'], 2) ?></td>
                    <td>
                        <a class="button-edit" href="produk.php?edit=<?= $row['id'] ?>">Edit</a>
                        <a class="button-delete" href="produk.php?delete=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus produk ini?')">Hapus</a>
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

<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>
    <h2>Tambah Produk</h2>
    <form method="post" enctype="multipart/form-data">
        <p>Nama Produk: <input type="text" name="nama_produk" required></p>
        <p>Kategori: <input type="text" name="kategori" required></p>
        <p>Harga: <input type="text" name="harga" required></p>
        <p>Stok: <input type="number" name="stok" required></p>
        <p>Gambar: <input type="file" name="gambar" accept="image/*" required></p>
        <p><button type="submit" name="submit">Simpan</button></p>
    </form>
    <a href="index.php">← Kembali</a>

    <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama_produk'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // Validasi upload gambar
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $error = $_FILES['gambar']['error'];

        if ($error === 0) {
            $upload_dir = "uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); // buat folder jika belum ada
            }

            $gambar = basename($gambar);
            $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);
            $gambar_baru = uniqid('img_', true) . '.' . strtolower($ekstensi);
            $path_simpan = $upload_dir . $gambar_baru;

            if (move_uploaded_file($tmp, $path_simpan)) {
                // Menggunakan prepared statement
                $stmt = $koneksi->prepare("INSERT INTO produk (nama_produk, kategori, harga, stok, gambar) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("ssdis", $nama, $kategori, $harga, $stok, $gambar_baru);

                if ($stmt->execute()) {
                    echo "<script>alert('Berhasil disimpan'); location.href='produk.php';</script>";
                } else {
                    echo "Gagal menyimpan ke database: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Gagal mengupload gambar.";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar.";
        }
    }
    ?>
</body>
</html>

<?php
session_start();
include_once('login/config.php');

$pesan_sukses = "";
$pesan_error = "";

if (!isset($_SESSION['user_id'])) {
    $is_logged_in = false;
} else {
    $is_logged_in = true;
    $user_id = $_SESSION['user_id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $is_logged_in) {
    $jenis = $_POST['jenis'] ?? '';
    $pesan = $_POST['pesan'] ?? '';

    $sql = "INSERT INTO kontak (user_id, jenis, pesan) VALUES (?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("iss", $user_id, $jenis, $pesan);

    if ($stmt->execute()) {
        $pesan_sukses = "Pesan berhasil dikirim!";
    } else {
        $pesan_error = "Gagal mengirim pesan: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Kontak Kami</title>
<style>
    body { font-family: Arial, sans-serif; background: #f4f7fa; padding: 40px; display: flex; justify-content: center;}
    .container { background: white; padding: 30px 40px; border-radius: 10px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); max-width: 450px; width: 100%; }
    h2 { text-align: center; margin-bottom: 25px; color: #333; }
    label { font-weight: 600; display: block; margin-bottom: 8px; color: #555; }
    select, textarea, input[type="text"] {
        width: 100%; padding: 10px 12px; border: 1.5px solid #ccc; border-radius: 6px; font-size: 15px; margin-bottom: 20px; box-sizing: border-box; resize: vertical;
    }
    select:focus, textarea:focus, input[type="text"]:focus {
        border-color: #4CAF50; outline: none;
    }
    input[type="submit"] {
        background-color: #4CAF50; color: white; border: none; padding: 14px; font-size: 16px; border-radius: 8px; cursor: pointer; width: 100%; transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover { background-color: #45a049; }
    .message { margin-bottom: 20px; text-align: center; font-weight: 600; }
    .message.success { color: #2e7d32; }
    .message.error { color: #d32f2f; }
    a.login-link { color: #4CAF50; text-decoration: none; font-weight: 600; }
    a.login-link:hover { text-decoration: underline; }
</style>
</head>
<body>
<div class="container">
    <h2>Form Kontak</h2>

    <?php if ($pesan_sukses): ?>
        <div class="message success"><?php echo $pesan_sukses; ?></div>
    <?php elseif ($pesan_error): ?>
        <div class="message error"><?php echo $pesan_error; ?></div>
    <?php endif; ?>

    <?php if ($is_logged_in): ?>
    <form method="POST" action="">
        <label for="jenis">Jenis Pesan:</label>
        <select name="jenis" id="jenis" required>
            <option value="" disabled selected>Pilih jenis pesan</option>
            <option value="keluhan">Keluhan</option>
            <option value="kritik">Kritik</option>
            <option value="saran">Saran</option>
        </select>

        <label for="pesan">Pesan:</label>
        <textarea name="pesan" id="pesan" rows="5" required></textarea>

        <input type="submit" value="Kirim">
    </form>
    <?php else: ?>
        <p>Anda harus <a class="login-link" href="login/index.php">login</a> terlebih dahulu untuk mengirim pesan.</p>
    <?php endif; ?>
</div>
</body>
</html>

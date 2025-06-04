<?php
session_start();
include_once("login/config.php");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "poppins", sans-serif;
            color: #333;
        }

        h1, h2 {
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-top: 30px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            color:rgb(16, 100, 27);
            font-size: 1.4rem;
            font-weight: 600;
        }

        .card-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .card-text {
            font-size: 1rem;
            color: #555;
        }

        .tombol {
            background-color:rgb(16, 103, 49);
            border-color:rgb(7, 123, 25);
            font-weight: 300;
            color: #f8f9fa;
            border-radius: 5px;
            font-size: 20px;
            transition: background-color 0.3s ease;
        }

        .tombol:hover {
            background-color:rgb(25, 118, 20);
            border-color:rgb(12, 107, 26);
        }

        .container {
            max-width: 900px;
            margin-top: 40px;
        }

        .button {
            background-color:rgb(16, 103, 49);
            color: #000;
            border-color:rgb(7, 123, 25);
            font-weight: 500;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            position: relative;
            top: 20px;
            left: 1050px;
        }

        .button a {
            text-decoration: none;
            color: white;
        }

        .button:hover {
            background-color:rgb(25, 118, 20);
            border-color:rgb(12, 107, 26);
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Page Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h1 class="mb-4">DAFTAR ARTIKEL</h1>

    <!-- Bagian Belajar -->
    <h2 class="mt-5">Kategori: Belajar</h2>
    <?php
    $sql_belajar = "SELECT * FROM artikel WHERE kategori_id = 1";
    $result_belajar = $conn->query($sql_belajar);

    if ($result_belajar->num_rows > 0) {
        while($row = $result_belajar->fetch_assoc()) {
            echo '
            <div class="card mb-3">
              <div class="card-body">
                <h4 class="card-title">' . htmlspecialchars($row["judul"]) . '</h4>
                <h6 class="card-subtitle mb-2 text-muted">Oleh ' . htmlspecialchars($row["penulis"]) . ' | ' . htmlspecialchars($row["tanggal_publikasi"]) . '</h6>
                <p class="card-text">' . nl2br(substr(htmlspecialchars($row["isi"]), 0, 200)) . '...</p>
                <a href="' . htmlspecialchars($row["link"]) . '" target="_blank" class="tombol">Read More</a>
              </div>
            </div>';
        }
    } else {
        echo "<p>Tidak ada artikel kategori belajar.</p>";
    }
    ?>

    <!-- Bagian Berita -->
    <h2 class="mt-5">Kategori: Berita</h2>
    <?php
    $sql_berita = "SELECT * FROM artikel WHERE kategori_id = 2";
    $result_berita = $conn->query($sql_berita);

    if ($result_berita->num_rows > 0) {
        while($row = $result_berita->fetch_assoc()) {
            echo '
            <div class="card mb-3">
              <div class="card-body">
                <h4 class="card-title">' . htmlspecialchars($row["judul"]) . '</h4>
                <h6 class="card-subtitle mb-2 text-muted">Oleh ' . htmlspecialchars($row["penulis"]) . ' | ' . htmlspecialchars($row["tanggal_publikasi"]) . '</h6>
                <p class="card-text">' . nl2br(substr(htmlspecialchars($row["isi"]), 0, 200)) . '...</p>
                <a href="' . htmlspecialchars($row["link"]) . '" target="_blank" class="tombol">Read More</a>
              </div>
            </div>';
        }
    } else {
        echo "<p>Tidak ada artikel kategori berita.</p>";
    }

    $conn->close();
    ?>
</div><br><br>
<button class="button"><a href="home.php">← Go Back</a></button>
</body>
</html>

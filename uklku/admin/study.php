<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data artikel</title>
    <style>
       /* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

/* Container */
.container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Header */
h1 {
    text-align: center;
    margin-bottom: 20px;
}

/* Form */
form {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

form input[type="text"],
form input[type="number"],
form textarea {
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form button {
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

form button:hover {
    background-color: #218838;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th,
table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #f1f1f1;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    justify-content: space-between;
}

.add ,
.delete-button {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.add {
    background-color: #007bff;
    color: white;
}

.add:hover {
    background-color: #0056b3;
}

.delete-button {
    background-color: #dc3545;
    color: white;
}

.delete-button:hover {
    background-color: #c82333;
}
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
    
    <h2 text-align="center">Daftar Pengguna</h2><br><br>
    <a href="tambah_data_study.php" class="add">Tambah Data</a>
    <table>
        <tr>
            <th>ID</th>
            <th>judul</th>
            <th>isi</th>
            <th>tanggal_publikasi</th>
            <th>penulis</th>
            <th>kategori id</th>
            <th>Link</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM artikel;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                 $href = !empty($row['link']) ? $row['link'] : "detail_artikel.php?id=" . $row['id'];
 
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['judul']}</td>
                        <td>{$row['isi']}</td>
                        <td>{$row['tanggal_publikasi']}</td>
                        <td>{$row['penulis']}</td>
                        <td>{$row['kategori_id']}</td>
                        <td><a href='" . htmlspecialchars($row['link']) . "' target='_blank'>" . 
            htmlspecialchars($row['link']) . " Lihat</a></td>
                    
                            <a class = 'delete-button' href='deleteartikel.php?id={$row['id']}' onclick='return confirm(\"Hapus data ini?\")'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
        }
        ?>
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
<?php
$conn->close();
?>

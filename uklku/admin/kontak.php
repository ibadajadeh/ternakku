<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar contact</title>
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

.edit-button,
.delete-button {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.edit-button {
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
nav{
  height:100px;
  width: 100%;
color: #fff;
display: flex;
justify-content: space-around;
align-items: center;
letter-spacing: 2px;
}
a{
  text-decoration: none;
  color: black;
  padding: 10px 20px;
  font-size: 20px;
}
header  a:hover,
header  a .menu,{
  background: yellowgreen;
  color:#fff;
  border-radius: 30px;}
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
    <header>
        <nav>
        <a href="study.php">Artikel</a>
        <a href="index.php">User Page</a>
        <a href="kategori.php">Kategori</a>
    </nav>
    </header>
    
    <h2>Daftar Pengguna</h2>
   <div class="add">
    <a class="add"href="add.php">Tambah Data</a>
</div>
        <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jenis Keluhan</th>
            <th>pesan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM contact";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['user_id']}</td>
                        <td>{$row['jenis']}</td>
                        <td>{$row['pesan']}</td>
                        <td>{$row['tanggal']}</td>

                        
                        <td>
                            <a class='edit-button' href='edit.php?id={$row['id']}'>Edit</a> |
                            <a class = 'delete-button' href='delete.php?id={$row['id']}' onclick='return confirm(\"Hapus data ini?\")'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada keluhan</td></tr>";
        }
        ?>
    </table>
</body>
<div class="crud">
<button><a href="index.php">User</a></button>
<button><a href="produk.php">Olshop</a></button>
<button><a href="pesanan.php">pemesanan</a></button>
<button><a href="study.php">Artikel</a></button>
<button><a href="kategori.php">Kategori Artikel</a></button>
</div>

</html>
<?php
$conn->close();
?>

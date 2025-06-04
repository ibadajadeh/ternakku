<?php
include 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['Judul'];
    $isi = $_POST['isi'];
      $waktu = $_POST['tanggal_publikasi']; 
        $penulis = $_POST['penulis'];
$kategori = $_POST['kategori_id']; 
$link = $_POST['link'];


    $sql = "INSERT INTO artikel (Judul, isi,tanggal_publikasi, penulis, kategori_id, link ) VALUES ('$judul', '$isi','$waktu', '$penulis','$kategori', '$link')";
        if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!";
        header("Location: study.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .artikel-container {
            background-color:rgba(77, 153, 0, 0.4);
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type='number']
        {
             width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;}
           
        
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color:rgb(9, 117, 9);
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color:rgb(59, 112, 13);
        }
        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
<head>
    <title>Tambah artikel</title>
</head>
<body><div class="artikel-container">
      <h2>Tambah Pengguna</h2>
    <form method="post" enctype="multipart/form-data">
        Judul: <input type="text" name="Judul" required><br><br>
        Isi: <input type="text" name="isi" required><br><br>
        Id Kategori harus Input: <input type="number" name="kategori_id" required><br><br>
        Tanggal: <input type="date" name="tanggal_publikasi" required><br><br>
        Penulis: <input type="text" name="penulis" required><br><br>
        Link: <input type="text" name="link" required><br><br>
        
              <input type="submit">
            
    </form>
    <br><br>
    <a href="study.php">Kembali</a>
</div>
  
</body>
</html>
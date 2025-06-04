<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
           
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-size: cover;
            background-repeat: no-repeat;
           
             
        }
        .bg-image{
             background-image: url(../img/download.jpeg);
             filter: blur(8px);
             -webkit-filter: blur(8px);
             height: 100%;
             background-position: center;
             background-repeat: no-repeat;
             background-size: cover;
        }
        .registrasi {
            background: #fff;
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
         input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color:rgb(53, 96, 15);
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #:rgb(53, 96, 15);
        }
        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
    <title>Tambah Pengguna</title>
</head>
<body>
    <div class="bg-image"></div>
    <div class="registrasi"> <h2>Tambah Pengguna</h2>
    <form method="post">
        <div class="form-group">  Nama: <input type="text" name="username" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Simpan"></div>
      
    </form>
    <a href="index.php">Kembali</a></div>
   
</body>
</html>
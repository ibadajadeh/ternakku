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
    <style>
        
  * {
    box-sizing: border-box;
  }
  /* Styling body dengan font modern dan gradien */
  body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg,rgb(85, 125, 22) 0%,rgb(15, 118, 61) 100%);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px 10px 30px;
  }
  /* Container utama untuk login dan app */
  #container {
    background:rgb(30, 146, 73);
    border-radius: 12px;
    width: 100%;
    max-width: 350px;
    max-height: 600px;
    padding: 20px;
    box-shadow: 0 12px 24px rgba(0,0,0,0.3);
    display: flex;
    flex-direction: column;
  }
  /* Judul besar */
  h2 {
    margin: 0 0 15px;
    font-weight: 700;
    font-size: 1.8rem;
    text-align: center;
    text-shadow: 0 2px 5px rgba(0,0,0,0.25);
  }
  /* Form styling */
  form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 20px;
  }
  /* Input field styling */
  input[type="text"],
  input[type="password"],
  input[type="email"]
  {
    padding: 12px 15px;
    border-radius: 8px;
    border: none;
    font-size: 1rem;
    transition: background 0.3s ease;
  }
  input[type="text"]:focus,
  input[type="password"]:focus 
  input[type="email"]:focus{
    outline: none;
    background:rgba(34, 179, 55, 0.35);
  }
  /* Button styling */
  input[type="submit"] {
    background:rgb(32, 115, 62);
    border: none;
    border-radius: 8px;
    padding: 12px 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: white;
    cursor: pointer;
    transition: background 0.3s ease;
  }
  input[type="submit"]:disabled {
    background:rgba(9, 146, 12, 0.55);
    cursor: not-allowed;
  }
  input[type="submit"]:hover:not(:disabled) {
    background:rgb(21, 137, 17);
  }
  a{
    color:black;
   font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
; 
   
 

  }
  
       </style>
    </style>
<head>
    <title>Tambah Pengguna</title>
</head>
<body>
    <div id="container"> <h2>Tambah Pengguna</h2>
    <form method="post">
        Nama: <input type="text" name="username" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Simpan">
    </form>
    <a href="index.php" >Kembali</a></div>
   
</body>
</html>
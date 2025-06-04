<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET username='$name', email='$email',password='password'  WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui!";
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
     body {
            font-family: Arial, sans-serif;
            background:  linear-gradient(to right, rgba(24, 123, 13, 0), rgb(7, 112, 112));;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-edit {
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
            border-radius: 10px;
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
            border-radius: 20px;
        }
        input[type="submit"]:hover {
            background-color: #:rgb(241, 241, 240);
            
        }
        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
   </style>
<head>
    
  <link rel="stylesheet" href="style.css">
    <title>Edit Pengguna</title>
</head>
<body>
    <div class="form-edit">
        <h2>Edit Pengguna</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Nama: <input type="text" name="name" value="<?php echo $row['username']; ?>" required><br><br>
        Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>
        password: <input type="password" name="password" value="<?php echo $row['password']; ?>" required><br><br>

        <input type="submit" value="Update">
    </form>
    <a href="index.php">Kembali</a>
    </div>
    
</body>
</html>

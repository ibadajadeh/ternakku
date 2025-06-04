<?php
include_once("config.php");

session_start();
// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .welcome {
            margin-bottom: 20px;
        }

        .logout {
            display: inline-block;
            padding: 8px 15px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .logout:hover {
            background-color: #c82333;
        }

        .cta {
            display: inline-block;
            padding: 8px 15px;
            background-color: rgb(21, 224, 45);
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .cta:hover {
            background-color: rgb(21, 224, 45);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="welcome">
            <p>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>
            <p>Anda telah berhasil login.</p>
        </div>
        <a href="logout.php" class="logout">Logout</a>
        <?php if ($_SESSION['role'] == 'admin') { ?>
            <a href="../admin/index.php?id=<?= $_SESSION['id'] ?>" class="cta">CRUD</a>
            <?php } elseif ($_SESSION['role'] == 'user') { ?>
                <a href="../home.php" class="cta">Home</a>
        <?php } ?>
    </div>
</body>

</html>
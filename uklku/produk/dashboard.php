<?php
// File: index.php (List Produk dengan Tampilan Menarik + Search + Header Info)
include 'config.php';
session_start();

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Toko Online</title>
    <style>
          
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #218838;
            color: white;
            padding: 1rem;
            text-align: center;
        }
      
        nav .search {
            background: #222;
            color: #fff;
            padding: 0.5rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .search form {
            margin: 0;
        }
        nav .search input[type="text"] {
            padding: 0.4rem;
            border-radius: 4px;
            border: none;
        }
        nav .search button {
            padding: 0.4rem 0.8rem;
            background: #e91e63;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .welcome {
            color: #aaa;
        }
        .container {
            width: 90%;
            margin: 2rem auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
        }
        .product {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            width: 250px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .product:hover {
            transform: scale(1.03);
        }
        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }
        .product h2 {
            font-size: 1.2rem;
            margin: 0.5rem 0;
        }
        .product p {
            font-size: 0.9rem;
            color: #555;
        }
        .price {
            color: #e91e63;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .add-to-cart {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .add-to-cart:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    
    <header>
        <button><a href="cart.php">Keranjang</a></button>
     
        <h1>Welcome To TernakStore!</h1>
        <nav class="search">
        <form method="GET" action="dashboard.php">
            <input type="text" name="search" placeholder="Cari produk..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" style="  background-color: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s">Cari</button>
        </form>
        <div class="welcome">
            <?php
            if (isset($_SESSION['id'])) {
                echo "👋 Hai, Selamat Datang <strong>" . $_SESSION['username'] . "</strong>.";
            } else {
                echo "🔍 Anda belum login. Silakan lihat-lihat produk kami!";
            }
            ?>
        </div>
    </nav>
    </header>
    
    <div class="container">
        <?php if ($result->num_rows > 0) { ?>
            <?php while($row = $result->fetch_assoc()) { ?>
            <div class="product">
                <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h2><?php echo $row['name']; ?></h2>
                <p><?php echo substr($row['description'], 0, 60); ?>...</p>
                <p class="price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
              <form method="POST" action="checkout.php">
    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
    <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
    <input type="submit" class="add-to-cart" value="CheckOut">
</form>
 <form method="POST" action="add_to_cart.php">
    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
    <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
    <input type="submit" class="add-to-cart" value="Tambah ke Keranjang">
</form>

            </div>
            
            <?php } ?>
        <?php } else { ?>
            <p style="text-align:center; font-size:1.2rem;">Produk tidak ditemukan.</p>
        <?php } ?>
    </div>
</body>
</html>



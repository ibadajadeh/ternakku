
<?php
session_start();
include_once("login/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<style>
    *{
  margin:0;
  padding:0;
  box-sizing: border-box;
}
body{
  background-color: #000;
  color: #fff;
  font-family: "poppins", sans-serif;
}
a{
  text-decoration: none;

}
header{
  width: 100%;
  height: 100vh;
  display: flex;
  position: relative;
  flex-direction: column;
  background-image: url("./img/download.jpeg");
  background-size: cover;
  background-position: center;
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
.logo{
 color: #fff;
  font-weight: 700;
  text-decoration: none;
  font-size: 2em;
  text-transform: uppercase;
  letter-spacing: 2px;
}
.inti a{
  text-decoration: none;
  color: #fff;
  padding: 10px 20px;
  font-size: 20px;
}
.login{
  text-decoration: none;
  color: #fff;
  padding: 10px 20px;
  font-size: 20px;
  background-color: chartreuse;
  border-radius: 20px;
}
header .inti a:hover,
header .inti a .menu{
  background: yellowgreen;
  color:#fff;
 border-radius: 30px;}
 .ternakku{
  position: absolute;
      top: 50%;
      left: 50%;
      width: 60%;
      transform: translate(-50%, -50%);
      text-align: center;
      text-transform: uppercase;
 }
 .ternakku h1{
  color: #fff;
  font-weight: 1000;
  font-size: 2.5em;
  letter-spacing: 0,1em;
 }
 .ternakku p{
  font-size: medium;
 }
 header button{
  padding: 15px 30px;
      border: 2px solid #2c2c2c;
      background-color: yellowgreen;
      color: #ffffff;
      font-size: 1.5em;
      cursor: pointer;
      border-radius: 30px;
      transition: all 0.5s ease;
      outline: none;
      position: relative;
      overflow: hidden;
      font-weight: bold;
      border-radius: 20px;
      margin-top: 15px;
      font-size: 1em;
 }
 button :hover{
  background:#000;
 }
 .btn::after{
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(
    circle,
    rgba(255, 255, 255, 0.25) 0%,
    rgba(30, 175, 85, 0) 70%
  );
  transform: scale(0);
  transition: transform 0.5s ease;
}
.btn:hover::after{
  transform: scale(4);
}
.btn:hover{
  border-color: #666666;
  background: #292929;
}
.btn a{
  color: #fff;
}
header::before{
  content: "";
  position: absolute;
  width: 100%;
  height: 60vh;
  bottom: 0;
  left: 0;
  background: linear-gradient(to top,rgb(0,0,0),rgba(0,0,0,0))
}
/*about*/
#about{
  width: 100%;
  padding: 2.5rem 0;
}
.about-container{
  width: 900px;
  margin: auto;
}
.about-container img{
  display: flex;
  width: 50%;
  min-height: 100px;
  border-radius: 10%;
  margin:0 220px;

}
/*study*/


</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,20
0;0,300;0,400;0,500;0,
600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <!--Page awal-->
    <header>
        <nav>
            <div class="logo">
                <a href="#">Ternakku</a>
            </div>
            <div class="inti">
                <a href="#about">About us</a>
                <a href="#contact">Contact Me</a>
                <a href="study.php">Artikel</a>
                <a href="produk/dashboard.php">OlShop</a>
                <a href="contact.php">Contact</a>
                
              </div>
            <div class="login">
                <?php if (!isset($_SESSION['username'])) { ?>
                    <a href="login/index.php">Login</a>
                <?php } else { ?>
                    <a href="login/logout.php">Log out</a>
                <?php } ?>
                </div>
        </nav>
        <div class="ternakku">
            <h1>Ternakku</h1>
            <p>Mau belajar bagaimana cara berternak Yuk Join Ternakku.</p>
            <a href="#about"><button class="btn">about</button></a>
        </div>
    </header>
    <!--about-->
    <section id="about">
        <div class="about-container">
            <img src="img/Landscape Hd Backgrounds.jpeg" alt=" Scenic View" class="image">
            <div class="text">
                <h3 align="center">About Us</h3>
                <i>Ternakku</i>
                <p align="justify">
                    Ternakku adalah website yang menyajukan pengetahuan
                    dasar mengenai berbagai macam hewan ternak dengan
                    penjelasan yang mudah dimengerti dan sangat menyenangka pastinya.
                    Di website ini juga menyajikan berita terkini mengenai seputar peternakan di indonesia.
                    Kalian juga bisa memesan produk di website ini dengan mengkontak admin.

                </p>
            </div>
    
</body>

</html>
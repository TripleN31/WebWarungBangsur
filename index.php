<?php
/*session_start();
if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Warung Bangsur</title>

  <!--fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,700&display=swap" rel="stylesheet" />

  <!--feather icons-->
  <script src="https://unpkg.com/feather-icons"></script>
  <!--my style-->
  <link rel="stylesheet" href="css/home.css" />
</head>

<body>
  <!--navbar-->
  <nav class="navbar">
    <a href="#" class="navbar-logo">Warung<span>Bangsur</span></a>

    <div class="navbar-nav">
      <a href="#">Home</a>
      <a href="#about">Tentang Kami</a>
      <a href="#menu">Menu</a>
      <a href="#contact">Kontak</a>
    </div>

    <div class="navbar-extra">
      <a href="menu.php" id="shopping-card"><i data-feather="shopping-cart"></i>></a>
      <a href="#" id="hamburger-menu"><i data-feather="menu"></i>></a>
    </div>
  </nav>

  <!--navbar end-->

  <!--hero section start-->
  <div>
    <section class="hero" id="home">
      <main class="content">
        <h1>Beli Satu</h1>
        <H1><span>Gratis</span> Satu</H1>
        <p>
          PEDESNYA BIKIN POLL!
        </p>
      </main>
      <a href="login.php" class="cta">Beli Sekarang</a>
  </div>
  </section>

  <!--hero section end-->

  <!--about section start-->
  <section id="about" class="about">
    <h2><span>Tentang</span>Kami</h2>

    <div class="row">
      <div class="about img">
        <img src="img/tentangkami.jpeg" alt="Tentang Kami" />
      </div>
      <div class="content">
        <h3>Kenapa Memilih Toko Kami?</h3>
        <p>
          Lorem ipsum dolor, sit amet consectetur adipisicing elit.
          Praesentium voluptas unde dolorem iste est eius.
        </p>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo
          cumque porro, error odit voluptate iste laboriosam modi nulla
          cupiditate.
        </p>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo
          cumque porro, error odit voluptate iste laboriosam modi nulla
          cupiditate.
        </p>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. In nemo
          cumque porro, error odit voluptate iste laboriosam modi nulla
          cupiditate.
        </p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, voluptas?</p>
      </div>
    </div>
  </section>
  <!--about section end-->

  <!--menu section start-->
  <section id="menu" class="menu">
    <h2><span>Menu</span>Kami</h2>
    <p>
      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus unde
      similique nobis ipsum labore laudantium?
    </p>

    <div class="row">
      <div class="menu-card">
        <img src="img/menu/1.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
        <h3 class="menu=card-title">-Ayam Geprek Sambal Matah-</h3>
        <p class="menu-card-prize">IDR 15K</p>
      </div>
    </div>
    <div class="row">
      <div class="menu-card">
        <img src="img/menu/1.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
        <h3 class="menu=card-title">-Ayam Geprek Sambal Matah-</h3>
        <p class="menu-card-prize">IDR 15K</p>
      </div>
    </div>
    <div class="row">
      <div class="menu-card">
        <img src="img/menu/1.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
        <h3 class="menu=card-title">-Ayam Geprek Sambal Matah-</h3>
        <p class="menu-card-prize">IDR 15K</p>
      </div>
    </div>
    <a class="row">
      <div class="menu-card">
        <img src="img/menu/1.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
        <h3 class="menu=card-title">-Ayam Geprek Sambal Matah-</h3>
        <p class="menu-card-prize">IDR 15K</p>
      </div>
      <a href="menu.php">lihat detail</a>
      </div>

  </section>
  <!--menu section end-->

  <!--contact section start-->
  <section id="contact" class="contact">
    <h2><span>Kontak</span>Kami</h2>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis,
      repellat.
    </p>
    <div class="row">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d127429.08481253167!2d98.55401566639007!3d3.550818821513813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sayam%20geprek%20bangsur!5e0!3m2!1sid!2sid!4v1716640610298!5m2!1sid!2sid"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
      <form action="">
        <div class="input-group">
          <i data-feather="user"></i>
          <input type="text" placeholder="nama" />
        </div>
        <div class="input-group">
          <i data-feather="mail"></i>
          <input type="text" placeholder="email" />
        </div>
        <div class="input-group">
          <i data-feather="phone"></i>
          <input type="text" placeholder="nohp" />
        </div>
        <button type="submit" class="btn">Kirim Pesan</button>
      </form>
    </div>
  </section>
  <!--contact section end-->

  <!--footer start-->
  <footer>
    <div class="social">
      <a href="#"><i data-feather="instagram"></i></a>
      <a href="#"><i data-feather="twitter"></i></a>
      <a href="#"><i data-feather="facebook"></i></a>
    </div>
    <div class="links">
      <a href="#home">Home</a>
      <a href="#about">about</a>
      <a href="#menu">Menu</a>
      <a href="#contact">Kontak</a>
    </div>
    <div class="credit">
      <p>Created by <a href="">Kelompok 8</a>. | &copy; 2024</p>
    </div>
  </footer>
  <!--footer end-->

  <!--feather icons-->
  <script>
    feather.replace();
  </script>

  <!--my javascript-->
  <script src="js/script.js"></script>
</body>

</html>
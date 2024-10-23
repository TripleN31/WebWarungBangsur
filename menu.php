<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,700&display=swap" rel="stylesheet" />

    <!--feather icons-->
    <script src="https://unpkg.com/feather-icons"></script>
    <!--my style-->
    <link rel="stylesheet" href="css/menu.css" />
</head>

<body>
    <!--menu-item-->
    <section class="hero" id="menu">
        <main class="content">
            <h1><span>Menu</span> Kami Disini</h1>
            <p>Warung bangsur menyadari, kelezatan, kesegaran dan kualitas menu yang disajikan adalah daya tarik
                utama, bukan teknik pemasaran yang bombastis dan tanpa isi.</p>
            <h3>Beli Satu Gratis Satu Khusus Ayam Geprek Original</h3>
        </main>
    </section>
    <form action="order.php" method="post">
        <div class="menu-item">
            <img src="img/menu/1.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
            <h3 class="menu-card-title">Ayam Geprek Sambal Matah</h3>
            <p class="menu-card-prize">IDR 15K</p>
            <p>Ayam geprek sambal matah yang spesial.</p>
            <label for="item1">Pesan:</label>
            <input type="number" id="item1" name="items[1]" min="0" value="0">
        </div>

        <div class="menu-item">
            <img src="img/menu/2.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
            <h3 class="menu-card-title">Ayam Geprek Original</h3>
            <p class="menu-card-prize">IDR 15K</p>
            <p>Ayam geprek sambal matah yang spesial.</p>
            <div>
                <label for="voucher">Masukkan Kode Voucher:</label>
                <input type="text" id="voucher" name="voucher">
            </div>
            <label for="item2">Pesan:</label>
            <input type="number" id="item2" name="items[2]" min="0" value="0">
        </div>


        <div class="menu-item">
            <img src="img/menu/4.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
            <h3 class="menu-card-title">Ayam Geprek Keju</h3>
            <p class="menu-card-prize">IDR 15K</p>
            <p>Ayam geprek sambal matah yang spesial.</p>
            <label for="item4">Pesan:</label>
            <input type="number" id="item4" name="items[4]" min="0" value="0">
        </div>


        <div class="menu-item">
            <img src="img/menu/6.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
            <h3 class="menu-card-title">Nasi Goreng Spesial</h3>
            <p class="menu-card-prize">IDR 15K</p>
            <p>Ayam geprek sambal matah yang spesial.</p>
            <label for="item6">Pesan:</label>
            <input type="number" id="item6" name="items[6]" min="0" value="0">
        </div>

        <div class="menu-item">
            <img src="img/menu/7.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
            <h3 class="menu-card-title">Teh Manis</h3>
            <p class="menu-card-prize">IDR 15K</p>
            <p>Ayam geprek sambal matah yang spesial.</p>
            <label for="item7">Pesan:</label>
            <input type="number" id="item7" name="items[7]" min="0" value="0">
        </div>

        <div class="menu-item">
            <img src="img/menu/8.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
            <h3 class="menu-card-title">Jus Jeruk</h3>
            <p class="menu-card-prize">IDR 15K</p>
            <p>Ayam geprek sambal matah yang spesial.</p>
            <label for="item8">Pesan:</label>
            <input type="number" id="item8" name="items[8]" min="0" value="0">
        </div>

        <div class="menu-item">
            <img src="img/menu/9.jpg" alt="Ayam Geprek Sambal Matah" class="menu-card-img" />
            <h3 class="menu-card-title">Cappucino</h3>
            <p class="menu-card-prize">IDR 15K</p>
            <p>Ayam geprek sambal matah yang spesial.</p>
            <label for="item9">Pesan:</label>
            <input type="number" id="item9" name="items[9]" min="0" value="0">
        </div>
        <button type="submit">Pesan Sekarang</button>
    </form>
    <!--menu-item end-->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $items = $_POST['items'];
        $voucher = $_POST['voucher'];
        $totalPrice = 0;

        $itemPrice = 15000;
        $voucherCode = 'B1G1';
        $voucherApplicableItem = 2; // ID untuk Ayam Geprek Original
    
        // Mengecek apakah voucher valid dan jika voucher berlaku untuk Ayam Geprek Original
        $validVoucher = ($voucher === $voucherCode);

        foreach ($items as $itemId => $quantity) {
            // Jika item adalah Ayam Geprek Original dan voucher valid
            if ($itemId == $voucherApplicableItem && $validVoucher) {
                // Hitung total harga dengan diskon beli 1 gratis 1
                $totalPrice += $itemPrice * ceil($quantity / 2);
            } else {
                // Hitung harga normal untuk item lainnya
                $totalPrice += $itemPrice * $quantity;
            }
        }

        echo "Total Harga: IDR " . number_format($totalPrice, 0, ',', '.') . "<br>";

        if (!$validVoucher) {
            echo "Kode voucher '$voucher' tidak valid.";
        }
    }
    ?>
</body>


</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="css/order.css">
</head>

<body>
    <div class="container">
        <h1>Pesanan Anda</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $items = $_POST['items'];
            $voucher = $_POST['voucher'];
            $totalPrice = 0;
            $itemPrice = 15000; // Harga satu item
            $itemNames = [
                1 => "Ayam Geprek Sambal Matah",
                2 => "Ayam Geprek Sambal Bawang",
                3 => "Ayam Geprek Sambal Hijau",
                4 => "Ayam Geprek Keju",
                5 => "Ayam Geprek Mozzarella",
                6 => "Ayam Geprek Sambal Terasi",
                7 => "Ayam Geprek Sambal Merah",
                8 => "Ayam Geprek Sambal Tomat",
                9 => "Ayam Geprek Sambal Ijo"
            ];

            echo "<ul class='order-list'>";
            // Hitung total harga
            foreach ($items as $item => $quantity) {
                if ($quantity > 0) {
                    if ($voucher === 'B1G1') {
                        // Logika beli satu gratis satu
                        $quantity = intval($quantity);
                        $itemTotal = $itemPrice * ceil($quantity / 2);
                    } else {
                        $itemTotal = $itemPrice * $quantity;
                    }
                    $totalPrice += $itemTotal;
                    echo "<li>Item $item: $quantity pcs - IDR " . number_format($itemTotal, 0, ',', '.') . "</li>";
                }
            }
            echo "</ul>";

            echo "<p class='total-price'>Total Harga: IDR " . number_format($totalPrice, 0, ',', '.') . "</p>";
        } else {
            echo "<p>Tidak ada pesanan yang ditemukan.</p>";
        }
        ?>
        <a href="menu.php" class="back-button">Kembali ke Menu</a>
    </div>
</body>

</html>
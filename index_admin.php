<?php
// Sertakan file koneksi database
include 'function.php';

// Fungsi PHP untuk menghitung bobot yang dinormalisasi
function normalisasi_bobot($bobot)
{
    $total = array_sum($bobot);
    if ($total == 0) {
        // Menghindari pembagian dengan nol
        return array_fill(0, count($bobot), 0);
    }
    return array_map(function ($bobot) use ($total) {
        return $bobot / $total;
    }, $bobot);
}

// Fungsi untuk menghitung skor akhir alternatif
function hitung_skor_akhir($bobot_kriteria, $bobot_alternatif)
{
    $skor_akhir = [];
    foreach ($bobot_alternatif as $alternatif => $bobot) {
        $skor_akhir[$alternatif] = 0;
        foreach ($bobot_kriteria as $kriteria => $bobot_k) {
            // Memeriksa jika kriteria ada dalam bobot alternatif
            if (isset($bobot[$kriteria])) {
                $skor_akhir[$alternatif] += $bobot_k * $bobot[$kriteria];
            }
        }
    }
    return $skor_akhir;
}


// Menangani pengiriman form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kriteria = ['MK', 'TP', 'PDT', 'BP'];
    $bobot_kriteria = [];
    $nilai_kriteria = [];
    $bobot_alternatif = [];

    foreach ($kriteria as $k) {
        $bobot_kriteria[$k] = isset($_POST["bobot_$k"]) ? floatval($_POST["bobot_$k"]) : 0;
        $nilai_kriteria[$k] = [];
        for ($i = 1; $i <= 3; $i++) {
            $nilai_kriteria[$k]["A$i"] = isset($_POST["nilai_{$k}_A$i"]) ? floatval($_POST["nilai_{$k}_A$i"]) : 0;
        }

        // Simpan bobot kriteria
        $stmt = $conn->prepare("INSERT INTO kriteria (kriteria, bobot) VALUES (?, ?)");
        $stmt->bind_param("sd", $k, $bobot_kriteria[$k]);
        $stmt->execute();
        $stmt->close();
    }

    // Matriks perbandingan berpasangan untuk alternatif
    $matriks_perbandingan = [
        'MK' => [
            'A1' => isset($_POST['bobot_MK_A1']) ? floatval($_POST['bobot_MK_A1']) : 0,
            'A2' => isset($_POST['bobot_MK_A2']) ? floatval($_POST['bobot_MK_A2']) : 0,
            'A3' => isset($_POST['bobot_MK_A3']) ? floatval($_POST['bobot_MK_A3']) : 0
        ],
        'TP' => [
            'A1' => isset($_POST['bobot_TP_A1']) ? floatval($_POST['bobot_TP_A1']) : 0,
            'A2' => isset($_POST['bobot_TP_A2']) ? floatval($_POST['bobot_TP_A2']) : 0,
            'A3' => isset($_POST['bobot_TP_A3']) ? floatval($_POST['bobot_TP_A3']) : 0
        ],
        'PDT' => [
            'A1' => isset($_POST['bobot_PDT_A1']) ? floatval($_POST['bobot_PDT_A1']) : 0,
            'A2' => isset($_POST['bobot_PDT_A2']) ? floatval($_POST['bobot_PDT_A2']) : 0,
            'A3' => isset($_POST['bobot_PDT_A3']) ? floatval($_POST['bobot_PDT_A3']) : 0
        ],
        'BP' => [
            'A1' => isset($_POST['bobot_BP_A1']) ? floatval($_POST['bobot_BP_A1']) : 0,
            'A2' => isset($_POST['bobot_BP_A2']) ? floatval($_POST['bobot_BP_A2']) : 0,
            'A3' => isset($_POST['bobot_BP_A3']) ? floatval($_POST['bobot_BP_A3']) : 0
        ]
    ];
    // Normalisasi bobot alternatif
    foreach ($matriks_perbandingan as $kriteria => $alternatif) {
        $total = array_sum($alternatif);
        foreach ($alternatif as $key => $value) {
            $matriks_perbandingan[$kriteria][$key] = $value / $total;
        }
    }

    // Menghitung bobot prioritas alternatif
    $bobot_alternatif = [];
    foreach ($matriks_perbandingan as $kriteria => $alternatif) {
        foreach ($alternatif as $key => $value) {
            if (!isset($bobot_alternatif[$key])) {
                $bobot_alternatif[$key] = 0;
            }
            $bobot_alternatif[$key] += $value;
        }
    }

    $bobot_alternatif = normalisasi_bobot($bobot_alternatif);

    // Simpan bobot alternatif
    foreach ($matriks_perbandingan as $kriteria => $alternatif) {
        foreach ($alternatif as $key => $value) {
            // Ambil ID kriteria dari database
            $stmt = $conn->prepare("SELECT id FROM kriteria WHERE kriteria = ?");
            $stmt->bind_param("s", $kriteria);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $kriteria_id = $row['id'];
            $stmt->close();

            // Simpan bobot alternatif
            $stmt = $conn->prepare("INSERT INTO alternatif (kriteria_id, alternatif, bobot) VALUES (?, ?, ?)");
            $stmt->bind_param("isd", $kriteria_id, $key, $value);
            $stmt->execute();
            $stmt->close();
        }
    }

    // Menghitung skor akhir alternatif
    $skor_akhir = hitung_skor_akhir($bobot_kriteria, $bobot_alternatif);

    // Menampilkan hasil
    echo "<h2>Hasil</h2>";
    echo "<p>Bobot Kriteria:</p>";
    foreach ($bobot_kriteria as $k => $bobot) {
        echo "<p>$k: $bobot</p>";
    }
    echo "<p>Bobot Alternatif:</p>";
    foreach ($bobot_alternatif as $alternatif => $bobot) {
        echo "<p>$alternatif: $bobot</p>";
    }
    echo "<p>Skor Akhir Alternatif:</p>";
    foreach ($skor_akhir as $alternatif => $skor) {
        echo "<p>$alternatif: $skor</p>";
    }

    // Menutup koneksi
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Warung Bangsur</title>
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,700&display=swap" rel="stylesheet" />

    <!--feather icons-->
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="css/index_admin.css">
</head>

<body>
    <h2>SPK MENENTUKAN PEODUK YANG TEPAT PADA STRATEGI PROMOSI "B1G1" DENGAN METODE AHP PADA WARUNG BANGSUR</h2>
    <h2>Input Kriteria dan Alternatif</h2>
    <form method="post" action="">
        <h3>Bobot Kriteria</h3>
        <label for="bobot_MK">Margin Keuntungan (MK):</label>
        <input type="number" id="bobot_MK" name="bobot_MK" step="0.001" required><br>
        <label for="bobot_TP">Tingkat Penjualan (TP):</label>
        <input type="number" id="bobot_TP" name="bobot_TP" step="0.001" required><br>
        <label for="bobot_PDT">Potensi Daya Tarik (PDT):</label>
        <input type="number" id="bobot_PDT" name="bobot_PDT" step="0.001" required><br>
        <label for="bobot_BP">Biaya Promosi (BP):</label>
        <input type="number" id="bobot_BP" name="bobot_BP" step="0.001" required><br>

        <h3>Nilai Alternatif</h3>
        <label for="bobot_MK_A1">MK - Ayam Geprek Original (A1):</label>
        <input type="number" id="bobot_MK_A1" name="bobot_MK_A1" step="0.001" required><br>
        <label for="bobot_MK_A2">MK - Ayam Geprek Keju (A2):</label>
        <input type="number" id="bobot_MK_A2" name="bobot_MK_A2" step="0.001" required><br>
        <label for="bobot_MK_A3">MK - Ayam Geprek Sambal Matah (A3):</label>
        <input type="number" id="bobot_MK_A3" name="bobot_MK_A3" step="0.001" required><br>

        <label for="bobot_TP_A1">TP - Ayam Goreng Pedas (A1):</label>
        <input type="number" id="bobot_TP_A1" name="bobot_TP_A1" step="0.001" required><br>
        <label for="bobot_TP_A2">TP - Ayam Goreng Biasa (A2):</label>
        <input type="number" id="bobot_TP_A2" name="bobot_TP_A2" step="0.001" required><br>
        <label for="bobot_TP_A3">TP - Ayam Goreng Kremes (A3):</label>
        <input type="number" id="bobot_TP_A3" name="bobot_TP_A3" step="0.001" required><br>

        <label for="bobot_PDT_A1">PDT - Paket Hemat (A1):</label>
        <input type="number" id="bobot_PDT_A1" name="bobot_PDT_A1" step="0.001" required><br>
        <label for="bobot_PDT_A2">PDT - Paket Premium (A2):</label>
        <input type="number" id="bobot_PDT_A2" name="bobot_PDT_A2" step="0.001" required><br>
        <label for="bobot_PDT_A3">PDT - Paket Special (A3):</label>
        <input type="number" id="bobot_PDT_A3" name="bobot_PDT_A3" step="0.001" required><br>

        <label for="bobot_BP_A1">BP - Diskon 10% (A1):</label>
        <input type="number" id="bobot_BP_A1" name="bobot_BP_A1" step="0.001" required><br>
        <label for="bobot_BP_A2">BP - Diskon 15% (A2):</label>
        <input type="number" id="bobot_BP_A2" name="bobot_BP_A2" step="0.001" required><br>
        <label for="bobot_BP_A3">BP - Diskon 20% (A3):</label>
        <input type="number" id="bobot_BP_A3" name="bobot_BP_A3" step="0.001" required><br>

        <input type="submit" value="Hitung">
        <a href="index.php" class="cta">Halaman Menu</a>
    </form>
</body>

</html>
<?php
// Script ini hanya contoh sederhana
// Sebaiknya menggunakan koneksi ke database jika diperlukan

// Fungsi untuk menghitung bobot kriteria dan alternatif
function calculateAHP($matrix)
{
    // Normalisasi matriks
    $colSums = array_map('array_sum', array_map(null, ...$matrix));
    $normalizedMatrix = array_map(function ($row) use ($colSums) {
        return array_map(function ($cell, $colSum) {
            return $cell / $colSum;
        }, $row, $colSums);
    }, $matrix);

    // Hitung bobot prioritas
    $averageRow = array_map(function ($row) {
        return array_sum($row) / count($row);
    }, $normalizedMatrix);

    return $averageRow;
}

// Contoh matriks perbandingan
$matrixKriteria = [
    [1, 3, 5, 7],
    [1 / 3, 1, 3, 5],
    [1 / 5, 1 / 3, 1, 3],
    [1 / 7, 1 / 5, 1 / 3, 1]
];

$weights = calculateAHP($matrixKriteria);

// Tampilkan hasil
echo "Bobot Kriteria:\n";
print_r($weights);

// Anda dapat menambahkan lebih banyak kode di sini untuk perhitungan alternatif dan penggabungan bobot
?>
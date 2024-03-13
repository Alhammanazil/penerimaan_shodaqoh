<?php

// Fungsi untuk string acak
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Periksa apakah 'kodetrx' sudah disimpan dalam sesi
if (!isset($_SESSION['kodetrx'])) {
    // Jika belum, hasilkan string acak dan simpan dalam sesi
    $_SESSION['kodetrx'] = generateRandomString(6);
}

// Ambil nilai 'kodetrx' dari sesi
$kodetrx = $_SESSION['kodetrx'];

function formatRibuan($angka)
{
$hasil = number_format($angka, 0, ',', '.');
return $hasil;
}
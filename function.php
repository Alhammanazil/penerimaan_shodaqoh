<?php
function generateRandomString($length = 10)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';

	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}

	return $randomString;
}

// Contoh penggunaan dengan panjang string tertentu (misalnya, 8 karakter)
$kodetrx = generateRandomString(8);

function extractNumber($string)
{
	return preg_replace('/[^0-9]/', '', $string);
}

function bulan($bln)
{
	$bulan = [
		1 => "Januari",
		2 => "Februari",
		3 => "Maret",
		4 => "April",
		5 => "Mei",
		6 => "Juni",
		7 => "Juli",
		8 => "Agustus",
		9 => "September",
		10 => "Oktober",
		11 => "November",
		12 => "Desember",
	];

	return $bulan[(int) $bln] ?? '';
}

// function input_detail_today()
// {
include "db_conn.php";
$sql = "SELECT * FROM input WHERE tanggal = CURDATE()";
$result = mysqli_query($conn, $sql);
$kodetrx = [];
while ($rows = mysqli_fetch_assoc($result)) {
	$kodetrx[] = $rows['kodetrx'];
}
var_dump($kodetrx);

// }
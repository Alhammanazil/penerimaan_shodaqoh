<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Input Detail Sumbangan</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" href="sweetalert2.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .navbar {
            border-radius: 0;
        }

        form {
            max-width: 750px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="checkbox"] {
            margin-top: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .qrcode-button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .qrcode-button img {
            width: 24px;
            height: 24px;
        }

        .qrcode-button:focus {
            outline: none;
        }
    </style>
</head>
<body>

<br> <br>
    <h2>Data Input Detail Form</h2>
    <br>

    <form action="insert_detail_data.php" method="post">

        <!-- NamaBarang -->
        <div class="form-group">
        <label for="nama_barang">Nama Barang:</label>
        <select id="nama_barang" name="nama_barang" class="form-control" required>
            <option value="Uang">Uang</option>
            <option value="Kerbau">Kerbau</option>
            <option value="Kambing">Kambing</option>
            <option value="Ayam">Ayam</option>
            <option value="Beras">Beras</option>
            <option value="Gula">Gula</option>
            <option value="Kecap">Kecap</option>
            <option value="Minyak Goreng (ltr)">Minyak Goreng (ltr)</option>
            <option value="Kain Biasa (Meter)">Kain Biasa (Meter)</option>
            <option value="Permadani">Permadani</option>
            <option value="Vitrage (Kelambu)">Vitrage (Kelambu)</option>
            <option value="Kain Primisima (Meter)">Kain Primisima (Meter)</option>
            <option value="Bawang Merah">Bawang Merah</option>
            <option value="Bawang Putih">Bawang Putih</option>
            <option value="Garam">Garam</option>
            <option value="Pisang">Pisang</option>
            <option value="Kelapa">Kelapa</option>
            <option value="Masker Medis">Masker Medis</option>
            <option value="Masker Kn95">Masker Kn95</option>
            <option value="Hand Sanitizer">Hand Sanitizer</option>
            <option value="Face Shield">Face Shield</option>
            <option value="Lain-lain">Lain-lain</option>
            <option value="Daun Jati">Daun Jati</option>
            <option value="Air Mineral">Air Mineral</option>
            <option value="Rokok (Bks)">Rokok (Bks)</option>
            <option value="Gula Merah">Gula Merah</option>
            <option value="Kopi / Teh">Kopi / Teh</option>
            <option value="Roti">Roti</option>
            <option value="Pengantar Hewan">Pengantar Hewan</option>
        </select>
        </div>

        <!-- TotalJumlah -->
        <div class="form-group">
            <label for="total_jumlah">Total Jumlah:</label>
            <input type="number" id="total_jumlah" name="total_jumlah" class="form-control" required>
        </div>

        <!-- Keterangan -->
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea id="keterangan" name="keterangan" class="form-control" rows="2"></textarea>
        </div>


        <!-- Load libraries -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://unpkg.com/html5-qrcode"></script>
        <script src="sweetalert2.min.js"></script>
</body>
</html>

<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Input Data</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" href="sweetalert2.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .sticky-top {
            margin: -10px -10px 10px -10px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        form {
            max-width: 750px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Updated shadow */
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#">Penerimaan Shodaqoh</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="input.php">Input Sedekah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Users</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <h2>Form Input Sedekah</h2>
    <br>

        <form action="/submit_sedekah" method="POST">
            <div class="form-group">
                <label for="operator">Nama Operator:</label>
                <input type="text" id="operator" name="operator" required class="form-control">
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" required class="form-control">
            <?php
            // FILEPATH: /c:/xampp/htdocs/login system/input.php
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Input Form</title>
                <!-- LOAD CSS LIBRARIES -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="sweetalert2.min.css">
            </head>
            <body>
                <form action="process.php" method="POST">
                    <div class="form-group">
                        <label for="gelar1">Gelar 1:</label>
                        <input type="text" id="gelar1" name="gelar1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gelar2">Gelar 2:</label>
                        <input type="text" id="gelar2" name="gelar2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" id="alamat" name="alamat" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Nomor Telepon:</label>
                        <input type="tel" id="telepon" name="telepon" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sumbangan">Total Sumbangan (Uang):</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" id="sumbangan" name="sumbangan" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sumbangan">Total Sumbangan (Barang):</label>
                        <div class="input-group">
                            <input type="number" id="sumbangan" name="sumbangan" required class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kartuSpesial">Kartu Spesial:</label>
                        <select id="kartuSpesial" name="kartuSpesial" class="form-control">
                            <option value="no">Tidak</option>
                            <option value="yes">Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kodeKartu">Kode Kartu:</label>
                        <input type="text" id="kodeKartu" name="kodeKartu" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ambilKartu">Ambil Kartu:</label>
                        <div class="input-group">
                            <input type="text" id="ambilKartu" name="ambilKartu" class="form-control" readonly>
                            <button type="button" onclick="scanQRCode()" class="qrcode-button">‎ ‎ 
                                <img src="https://uxwing.com/wp-content/themes/uxwing/download/computers-mobile-hardware/qr-code-icon.png" alt="QR Code">
                            </button>
                        </div>
                    </div> <br>

                    <div class="form-group">
                        <label for="detailSumbangan"></label>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal">
                            Input Detail Sumbangan +
                        </button>
                    </div><br>

                    <div class="container">
                        <div class="row">
                            <table id="detail-sumbangan" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Total Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Beras</td>
                                        <td>10</td>
                                        <td>beras 10kg</td>
                                    </tr>
                                    <tr>
                                        <td>Uang</td>
                                        <td>500.000</td>
                                        <td>mang asep</td>
                                    </tr>
                                    <tr>
                                        <td>Gula</td>
                                        <td>5</td>
                                        <td>gula 5kg</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="text" id="namaBarangModal" name="namaBarang" class="form-control"></td>

                                        <td><input type="number" id="totalJumlahModal" name="totalJumlah" class="form-control"></td>

                                        <td><input type="text" id="keteranganModal" name="keterangan" class="form-control"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>


                <!-- Detail Modal -->
                <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">Detail Sumbangan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="namaBarangModal">Nama Barang:</label>
                                        <input type="text" id="namaBarangModal" name="namaBarang" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="totalJumlahModal">Total Jumlah:</label>
                                        <input type="number" id="totalJumlahModal" name="totalJumlah" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="keteranganModal">Keterangan:</label>
                                        <textarea id="keteranganModal" name="keterangan" class="form-control" required></textarea>
                                    </div>                        
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" id="detailModalSaveBtn" onclick="saveDetail()">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LOAD LIBRARIES -->
                <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
                <script src="https://unpkg.com/html5-qrcode"></script>
                <script src="sweetalert2.min.js"></script>

                <script>
                    $(document).ready(function () {
                        // Inisialisasi DataTables dengan ID yang sesuai
                        var detailTable = $('#detail-sumbangan').DataTable();

                        // Tombol "Simpan" di modal detail dengan ID yang sesuai
                        $('#detailModalSaveBtn').on('click', function () {
                            saveDetail();
                        });

                        function saveDetail() {
                            const namaBarang = $('#namaBarangModal').val();
                            const totalJumlah = $('#totalJumlahModal').val();
                            const keterangan = $('#keteranganModal').val();

                            if (namaBarang && totalJumlah && keterangan) {
                                // Tambahkan data ke dalam tabel DataTables
                                detailTable.row.add([namaBarang, totalJumlah, keterangan]).draw();

                                // Kosongkan formulir modal
                                $('#namaBarangModal').val('');
                                $('#totalJumlahModal').val('');
                                $('#keteranganModal').val('');

                                // Tutup modal
                                $('#detailModal').modal('hide');
                            } else {
                                alert('Mohon lengkapi semua isian sebelum menyimpan.');
                            }
                        }

                        function scanQRCode() {
                            const htmlScanner = new Html5QrcodeScanner("ambilKartu", { fps: 10, qrbox: 250 });
                            htmlScanner.render(onScanSuccess);
                        }

                        function onScanSuccess(decodeText, decodeResult) {
                            document.getElementById("ambilKartu").value = decodeText;
                            htmlScanner.clear(); // Membersihkan pemindai setelah pemindaian berhasil
                        }
                    });
                </script>
            </body>
            </html>

            <?php }else{
	header("Location: index.php");
} ?>
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

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"/>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

        <link rel="stylesheet" href="sweetalert2.min.css">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
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
                max-width: 650px;
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <a class="navbar-brand" href="#">Penerimaan Shodaqoh</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
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

        <!-- Form Input Sedekah -->
        <form action="php/input.php" method="POST">
            <!-- Field Nama Operator -->
            <div class="form-group">
                <label for="operator">Nama Operator:</label>
                <input type="text" id="operator" name="operator" required class="form-control">
            </div>

            <!-- Field Tanggal -->
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" required class="form-control">
            </div>

            <!-- Field Gelar 1 (Gunakan Dropdown) -->
            <div class="form-group">
                <label for="gelar1">Gelar 1:</label>
                <select id="gelar1" name="gelar1" class="form-select">
                    <option value=""></option>
                    <option value="H">H</option>
                    <option value="Hj">Hj</option>
                    <option value="KH">KH</option>
                    <option value="Dr">Dr</option>
                    <option value="dr">dr</option>
                    <option value="drs">drs</option>
                    <option value="R">R</option>
                    <option value="R.H">R.H</option>
                </select>
            </div>

            <!-- Field Nama -->
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required class="form-control">
            </div>

            <!-- Field Gelar 2 (Gunakan Dropdown) -->
            <div class="form-group">
                <label for="gelar2">Gelar 2:</label>
                <select id="gelar2" name="gelar2" class="form-select">
                    <option value=""></option>
                    <option value="ST">ST</option>
                    <option value="SE">SE</option>
                    <option value="Alm.">Alm.</option>
                    <option value="SH">SH</option>
                    <option value="S.Ag">S.Ag</option>
                </select>
            </div>

            <!-- Field Alamat -->
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" required class="form-control">
            </div>

            <!-- Field Nomor Telepon -->
            <div class="form-group">
                <label for="telepon">Nomor Telepon:</label>
                <input type="tel" id="telepon" name="telepon" class="form-control">
            </div>

            <!-- Field Total Sumbangan (Uang) -->
            <div class="form-group">
                <label for="sumbangan_uang">Total Sumbangan (Uang):</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" id="sumbangan_uang" name="sumbangan_uang" required class="form-control">
                </div>
            </div>

            <!-- Field Total Sumbangan (Barang) -->
            <div class="form-group">
                <label for="sumbangan_barang">Total Sumbangan (Barang):</label>
                <div class="input-group">
                    <input type="number" id="sumbangan_barang" name="sumbangan_barang" required class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">Kg</span>
                    </div>
                </div>
            </div>

            <!-- Field Kode Kartu -->
            <div class="form-group">
                <label for="kode_kartu">Kode Kartu:</label>
                <select id="kode_kartu" name="kode_kartu" required class="form-select">
                    <option value="K">K</option>
                    <option value="B">B</option>
                </select>
            </div>

            <!-- Ambil Kartu -->
            <div class="form-group" id="update_form">
                <label for="ambilKartu">Ambil Kartu:</label>
                <div class="input-group" id="reader"></div>
                <input id="barcode_search" placeholder="Barcode" name="ambil_kartu" required class="form" />
                <button id="start_reader" class="qrcode-button"> ‎
                    <img src="https://uxwing.com/wp-content/themes/uxwing/download/computers-mobile-hardware/qr-code-icon.png" alt="QR Code">
                </button>
            </div>
            <br>

            <!-- Button Detail Sumbangan -->
            <div class="form-group">
                <label for="detailSumbangan"></label>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal" onclick="window.location.href = 'input_detail.php';">
                    Input Detail Sumbangan +
                </button>
            </div>
            <br>

            <!-- Tabel Detail Sumbangan -->
            <div class="container">
                <div class="row">
                    <table id="detail-sumbangan" class="display" style="width:100%">
                        <!-- Kolom Tabel -->
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Total Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data Contoh -->
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
                        <!-- Form Input Baris Baru -->
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

            <!-- Tombol Submit -->
            <input type="submit" value="Submit" class="btn btn-primary">
        </form> <br><br>

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

        <!-- Load libraries -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://unpkg.com/html5-qrcode"></script>
        <script src="sweetalert2.min.js"></script>

        <script>
            $(document).ready(function() {
                var detailTable = $('#detail-sumbangan').DataTable();

                // Tombol "Simpan" di modal detail dengan ID yang sesuai
                $('#detailModalSaveBtn').on('click', function() {
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

                // QR Code Scanner
                // Create a QR code reader instance
                const qrReader = new Html5Qrcode("reader");

                // QR reader settings
                const qrConstraints = {
                    facingMode: "environment"
                };
                const qrConfig = {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                };
                const qrOnSuccess = (decodedText, decodedResult) => {
                    stopScanner(); // Stop the scanner
                    console.log(`Message: ${decodedText}, Result: ${JSON.stringify(decodedResult)}`);
                    $("#barcode_search").val(decodedText); // Set the value of the barcode field
                    $("#update_form").trigger("submit"); // Submit form to backend
                };

                // Methods: start / stop
                const startScanner = () => {
                    $("#reader").show();
                    $("#product_info").hide();
                    qrReader.start(
                        qrConstraints,
                        qrConfig,
                        qrOnSuccess,
                    ).catch(console.error);
                };

                const stopScanner = () => {
                    $("#reader").hide();
                    $("#product_info").show();
                    qrReader.stop().catch(console.error);
                };

                // Start scanner on button click
                $(document).on("click", "#start_reader", function() {
                    startScanner();
                });

                // Submit 
                $("#update_form").on("submit", function(evt) {
                    evt.preventDefault();

                    $.ajax({
                        type: "POST",
                        url: "../my-scanner-script.php",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(res) {
                            console.log(res);
                            if (res.status === "success") {
                                // Attempt to start the scanner
                                startScanner();
                            }
                        }
                    });
                });
            });
        </script>

    </body>

    </html>

<?php
} else {
    header("Location: index.php");
}
?>
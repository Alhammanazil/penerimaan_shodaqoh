<?php
session_start();
include "db_conn.php";
include "function.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {  ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
        <title>Input Data</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            // Periksa apakah pengguna sudah login
            if (isset($_SESSION['username'])) {
                $namaOperator = $_SESSION['name'];
            } else {
                $namaOperator = '';
            }
            ?>

            <!-- Kodetrx -->
            <div class="form-group">
                <?php $kodetrx = generateRandomString(6); ?>
                <label for="kodetrx">kodetrx:</label>
                <input type="text" id="kodetrx" name="kodetrx" required class="form-control" value="<?php echo $kodetrx ?>" readonly>
            </div>

            <!-- Field Nama Operator -->
            <div class="form-group">
                <label for="operator">Nama Operator:</label>
                <input type="text" id="operator" name="operator" required class="form-control" value="<?php echo $namaOperator; ?>" readonly>
            </div>

            <!-- Field Tanggal -->
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" required class="form-control" value="<?php echo date('Y-m-d'); ?>">
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
                <select class="form-select" name="lengkap" id="lengkap" required>
                    <option value="" disabled selected>Masukkan alamat penyumbang</option>
                    <?php
                    include "db_conn.php";

                    $query = mysqli_query($conn, "SELECT * FROM tb_alamat");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <option value="<?php echo $data['lengkap']; ?>"><?php echo $data['lengkap']; ?></option>

                    <?php
                    }
                    ?>
                </select>
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
                    <?php
                    include 'php/data-input.php';
                    // Check if $res is defined and is a mysqli_result object
                    if (isset($res) && $res instanceof mysqli_result) {
                        // Calculate the sum of 'sumbangan_uang' column
                        $total_uang = 0;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $total_uang += $row['total_nominal'];
                        }
                        mysqli_free_result($res);
                    } else {
                        $total_uang = 0;
                    }
                    ?>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" id="sumbangan_uang" name="sumbangan_uang" required class="form-control" value="<?= $total_uang ?>" readonly>
                </div>
            </div>

            <!-- Field Total Sumbangan (Barang) -->
            <div class="form-group">
                <label for="sumbangan_barang">Total Sumbangan (Barang):</label>
                <div class="input-group">
                    <?php
                    include 'php/data-input.php';
                    // Check if $res is defined and is a mysqli_result object
                    if (isset($res) && $res instanceof mysqli_result) {
                        // Calculate the sum of 'total_jumlah' column
                        $total = 0;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $total += $row['total_jumlah'];
                        }
                        mysqli_free_result($res);
                    } else {
                        $total = 0;
                    }
                    ?>
                    <div class="input-group-append">
                        <span class="input-group-text">Kg</span>
                    </div>
                    <input type="number" id="sumbangan_barang" name="sumbangan_barang" required class="form-control" value="<?= $total ?>" readonly>
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

            <input type="submit" value="Submit" class="btn btn-primary">
        </form> <br><br>


        <div class="form-group">
            <label for="detailSumbangan"></label>
            <!-- Menggunakan link dengan parameter kodetrx -->
            <a href="input_detail.php?kodetrx=<?php echo $kodetrx; ?>" class="btn btn-primary">
                Input Detail Sumbangan +
            </a>
        </div>
        <br>

        <!-- Tabel Detail Sumbangan -->
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Detail Sumbangan
            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Data +
                </button>
                <?php include 'php/data-input.php';
                if (mysqli_num_rows($res) > 0) { ?>
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Nama Barang</th>
                            <th>Total Nominal</th>
                            <th>Total Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        while ($rows = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <td><?= $rows['nama_barang'] ?></td>
                                <td><?= $rows['total_jumlah'] ?></td>
                                <td><?= $rows['total_nominal'] ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning">Edit</a>
                                    <a href="#" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                    <!-- Awal Modal -->
                    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Detail Sumbangan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="php/input_detail.php" method="POST">
                                        <!-- NamaBarang -->
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang:</label>
                                            <select class="form-select" id="nama_barang" name="nama_barang" required>
                                                <option value="" disabled selected>Pilih nama barang</option>
                                                <?php
                                                include "db_conn.php";

                                                $query = mysqli_query($conn, "SELECT * FROM tb_barang");
                                                while ($data = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $data['nama_barang']; ?>"><?php echo $data['nama_barang']; ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- TotalNominal -->
                                        <div class="form-group" id="total_nominal_group">
                                            <label for="total_nominal">Total Nominal:</label>
                                            <input type="number" id="total_nominal" name="total_nominal" class="form-control" required>
                                        </div>

                                        <!-- TotalJumlah -->
                                        <div class="form-group" id="total_jumlah_group">
                                            <label for="total_jumlah">Total Jumlah:</label>
                                            <input type="number" id="total_jumlah" name="total_jumlah" class="form-control" step="0.01" required>
                                        </div>

                                        <!-- NamaSubSumbangan -->
                                        <div class="form-group" id="nama_sub_sumbangan_group">
                                            <label for="nama_sub_sumbangan">Nama Sub Sumbangan:</label>
                                            <select class="form-select" id="nama_sub_sumbangan" name="nama_sub_sumbangan" required>
                                                <option value="SHODAQOH">SHODAQOH</option>
                                                <option value="AQIQAH">AQIQAH</option>
                                                <option value="NADZAR">NADZAR</option>
                                            </select>
                                        </div>

                                        <!-- AtasNama -->
                                        <div class="form-group" id="atas_nama_group">
                                            <label for="atas_nama">Atas Nama:</label>
                                            <input type="text" id="atas_nama" name="atas_nama" class="form-control">
                                        </div>

                                        <!-- Keterangan -->
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan:</label>
                                            <textarea id="keterangan" name="keterangan" class="form-control" rows="2"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <br> <br>
        <br>
        <!-- Akhir modal -->



        <!-- Load libraries -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://unpkg.com/html5-qrcode"></script>
        <script src="sweetalert2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.form-select').select2();

                $("#total_jumlah_group").hide();
                $("#nama_sub_sumbangan_group").hide();
                $("#atas_nama_group").hide();

                // Show/hide fields based on the selected value
                $("#nama_barang").change(function() {
                    var selectedValue = $(this).val();

                    if (selectedValue === "") {
                        $("#total_nominal_group").hide();
                        $("#total_jumlah_group").hide();
                        $("#nama_sub_sumbangan_group").hide();
                        $("#atas_nama_group").hide();
                        $("#total_nominal").prop("required", false);
                        $("#total_jumlah").prop("required", false);
                        $("#nama_sub_sumbangan").prop("required", false);
                        $("#atas_nama").prop("required", false);
                    } else if (selectedValue === "Uang") {
                        $("#total_nominal_group").show();
                        $("#total_jumlah_group").hide();
                        $("#nama_sub_sumbangan_group").hide();
                        $("#atas_nama_group").hide();
                        $("#total_nominal").prop("required", true);
                        $("#total_jumlah").prop("required", false);
                        $("#nama_sub_sumbangan").prop("required", false);
                        $("#atas_nama").prop("required", false);
                    } else if (selectedValue === "Kerbau" || selectedValue === "Kambing") {
                        $("#total_nominal_group").hide();
                        $("#total_jumlah_group").show();
                        $("#nama_sub_sumbangan_group").show();
                        $("#atas_nama_group").show();
                        $("#total_nominal").prop("required", false);
                        $("#total_jumlah").prop("required", true);
                        $("#nama_sub_sumbangan").prop("required", true);
                        $("#atas_nama").prop("required", true);
                    } else {
                        $("#total_nominal_group").hide();
                        $("#total_jumlah_group").show();
                        $("#nama_sub_sumbangan_group").hide();
                        $("#atas_nama_group").hide();
                        $("#total_nominal").prop("required", false);
                        $("#total_jumlah").prop("required", true);
                        $("#nama_sub_sumbangan").prop("required", false);
                        $("#atas_nama").prop("required", false);
                    }
                });
            });
        </script>

        <script>
            //select2min
            $(document).ready(function() {
                $('.form-select').select2();
            });
            // DataTable
            $(document).ready(function() {
                var detailTable = $('#detail-sumbangan').DataTable();

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
            }
?>
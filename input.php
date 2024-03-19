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

        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

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
                font-weight: 600;
            }

            .navbar {
                border-radius: 0;
            }

            a {
                text-decoration: none;
                color: #333;
            }

            form {
                max-width: 900px;
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
        <!-- Navbar Start -->
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
                        <a class="nav-link" href="form.php">Input Sedekah</a>
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
        <!-- Navbar End -->

        <!-- Judul Halaman -->
        <br>
        <h2 class="text-center">Form Input Sedekah</h2><br>
        <!-- Judul Halaman -->

        <!-- Form Input Sedekah Awal -->
        <form id="inputForm" action="php/input.php" method="POST">
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

            <a href="form.php"><i class='bx bxs-left-arrow-circle' aria-hidden="true"></i> Back</a><br>

            <!-- Kodetrx -->
            <br>
            <div class="form-group">
                <?php
                if (!empty($_GET['kodetrx'])) {
                    $kodetrx = $_GET['kodetrx'];

                    $query = mysqli_query($conn, "SELECT * FROM input WHERE kodetrx='" . $kodetrx . "'");
                    $data = mysqli_fetch_array($query);
                    $gelar1 = $data['gelar1'];
                    $nama = $data['nama'];
                    $gelar2 = $data['gelar2'];
                    $alamat = $data['alamat'];
                    $telepon = $data['telepon'];
                    $kode_kartu = $data['kode_kartu'];
                    $ambil_kartu = $data['ambil_kartu'];
                } else {
                    $kodetrx = generateRandomString(6);
                    $gelar1 = null;
                    $nama = null;
                    $gelar2 = null;
                    $alamat = null;
                    $telepon = null;
                    $kode_kartu = null;
                    $ambil_kartu = null;
                }
                ?>
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
                    <option value="<?= $gelar1; ?>" selected><?= $gelar1; ?></option>
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
                <input type="text" id="nama" name="nama" required class="form-control" value="<?= $nama; ?>">
            </div>

            <!-- Field Gelar 2 (Gunakan Dropdown) -->
            <div class="form-group">
                <label for="gelar2">Gelar 2:</label>
                <select id="gelar2" name="gelar2" class="form-select">
                    <option value=""></option>
                    <option value="<?= $gelar2; ?>" selected><?= $gelar2; ?></option>
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

                    $query = mysqli_query($conn, "SELECT * FROM tb_alamat");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <option value="<?= $alamat; ?>" selected><?= $alamat; ?></option>
                        <option value="<?php echo $data['lengkap']; ?>"><?php echo $data['lengkap']; ?></option>

                    <?php
                    }
                    ?>
                </select>
            </div>

            <!-- Field Nomor Telepon -->
            <div class="form-group">
                <label for="telepon">Nomor Telepon:</label>
                <input type="tel" id="telepon" name="telepon" class="form-control" value="<?= $telepon; ?>">
            </div>

            <!-- Field Total Sumbangan (Uang) -->
            <div class="form-group">
                <label for="sumbangan_uang">Total Sumbangan (Uang):</label>
                <div class="input-group">
                    <?php
                    $sql = "SELECT * FROM input_detail WHERE kodetrx='" . $kodetrx . "'";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        $array = [];
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $array[] = $rows['total_nominal'];
                        }
                        $total_nominal = array_sum($array);
                    } else {
                        $total_nominal = 0;
                    }
                    ?>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" id="sumbangan_uang" name="sumbangan_uang" required class="form-control" value="<?= number_format($total_nominal, 0, ',', '.'); ?>" readonly>
                </div>
            </div>

            <!-- Field Total Sumbangan (Barang) -->
            <div class="form-group">
                <label for="sumbangan_barang">Total Sumbangan (Barang):</label>
                <div class="input-group">
                    <?php
                    $sql = "SELECT * FROM input_detail WHERE kodetrx='" . $kodetrx . "'";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        $array = [];
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $array[] = $rows['total_jumlah'];
                        }
                        $total_jumlah = array_sum($array);
                    } else {
                        $total_jumlah = 0;
                    }
                    ?>
                    <div class="input-group-append">
                    </div>
                    <input type="number" id="sumbangan_barang" name="sumbangan_barang" required class="form-control" value="<?= $total_jumlah ?>" readonly>
                    <span class="input-group-text">Satuan</span>
                </div>
            </div>

            <!-- Field Kode Kartu -->
            <div class="form-group">
                <label for="kode_kartu">Kode Kartu:</label>
                <select id="kode_kartu" name="kode_kartu" required class="form-select">
                    <option value="<?= $kode_kartu; ?>"><?= $kode_kartu; ?></option>
                    <option value="K">K</option>
                    <option value="B">B</option>
                </select>
            </div>

            <!-- Ambil Kartu -->
            <div class="form-group" id="update_form">
                <label for="ambilKartu">Ambil Kartu:</label>
                <div class="input-group" id="reader"></div>
                <input id="barcode_search" placeholder="ID Kartu" name="ambil_kartu" required class="form" value="<?= $ambil_kartu; ?>" readonly required>
                <!-- <div class="input-group-prepend">
                    <span class="input-group-text"><a href="#" id="check" onclick="checkBarcode(); return false;">Check</a></span>
                </div> -->
                <br><br>
                <a href="#" id="start_reader" class="qrcode-button">
                    <img src="https://uxwing.com/wp-content/themes/uxwing/download/computers-mobile-hardware/qr-code-icon.png" alt="Scan QR Code">
                    Scan QR Code
                </a>
            </div> <br>

            <!-- Tombol Submit -->
            <?php
            $q = "SELECT * FROM input WHERE kodetrx='" . $kodetrx . "'";
            $r = mysqli_query($conn, $q);
            if (mysqli_num_rows($r) == 0) {
                echo '<input type="submit" value="submit" class="btn btn-primary">';
            }
            ?>

        </form> <br><br>
        <!-- Form Input Sedekah Akhir -->

        <!-- Tabel Detail Sumbangan Awal -->
        <form id="detailForm">

            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    Detail Sumbangan
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="detailSumbangan"></label>
                        <!-- Button tambah data -->
                        <a href="input_detail.php?kodetrx=<?php echo $kodetrx; ?>" class="btn btn-success">
                            Tambah Data +
                        </a>
                    </div>
                    <?php
                    $sql = "SELECT * FROM input_detail WHERE kodetrx='" . $kodetrx . "'";
                    $res = mysqli_query($conn, $sql);
                    ?>
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
                                <td><?= number_format($rows['total_nominal'], 0, ',', '.') ?></td>
                                <td><?= $rows['total_jumlah'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-btn" data-kodetrx_detail="<?= $rows['kodetrx_detail'] ?>"><i class="bx bxs-trash"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div> <br>
            <?php if (mysqli_num_rows($res) > 0) { ?>
                <a href="form.php" class="btn btn-success end" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan input data sumbangan ini?')"><i class="bx bx-check-square"></i> Selesai</a>
            <?php } ?>
        </form>
        <footer id="bottom"></footer>
        <br>
        <!-- Tabel Detail Sumbangan Akhir -->

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
            // buat agar form detail tidak muncul sebelum user submit form input
            $("#detailForm").hide();

            // jika link sudah get kodetrx dari form input, maka munculkan form detail
            if (window.location.search) {
                $("#detailForm").show();
            }
        </script>

        <script>
            // Cek kode kartu
            // function checkBarcode() {
            //     var barcode = document.getElementById('barcode_search').value;
            //     if (barcode) {
            //         // Check if barcode is already in database
            //         var xhr = new XMLHttpRequest();
            //         xhr.open('GET', 'php/cek-kartu.php?barcode=' + barcode, true);
            //         xhr.onload = function() {
            //             if (this.responseText === 'true') {
            //                 document.getElementById('barcode_search')
            //                 alert('Kartu SUDAH dipakai');
            //             } else {
            //                 alert('Kartu BELUM dipakai');
            //             }
            //         };
            //         xhr.send();
            //     } else {
            //         alert('Masukkan barcode terlebih dahulu');
            //     }
            // }

            // Hapus data
            $(document).ready(function() {
                $(".delete-btn").click(function() {
                    var kodetrx_detail = $(this).data("kodetrx_detail");
                    if (confirm("Apakah Anda yakin ingin menghapus item ini?")) {
                        $.ajax({
                            url: 'php/hapus_data.php',
                            method: 'POST',
                            data: {
                                kodetrx_detail: kodetrx_detail
                            },
                            success: function(response) {
                                location.reload();
                            }
                        });
                    }
                });
            });

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

                const qrCheck = (barcode) => {
                    // var barcode = document.getElementById('barcode_search').value;

                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'php/cek-kartu.php?barcode=' + barcode, true);
                    xhr.onload = function() {
                        if (this.responseText === 'true') {
                            $("#barcode_search").val(null)
                            alert('Kartu SUDAH dipakai');
                        } else {
                            $("#barcode_search").val(barcode)
                            // alert('Kartu BELUM dipakai');
                        }
                    };
                    xhr.send();
                }

                const qrOnSuccess = (decodedText, decodedResult) => {
                    stopScanner(); // Stop the scanner
                    console.log(`Message: ${decodedText}, Result: ${JSON.stringify(decodedResult)}`);
                    qrCheck(decodedText);
                    // $("#barcode_search").val(decodedText); // Set the value of the barcode field
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
    // } else {
    //     header("Location: index.php");
    // }
}
?>
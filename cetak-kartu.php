<?php
session_start();
include "db_conn.php";
include "function.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/logo pbl 1446 PUTIH OYEE.png" type="image/x-icon">
        <title>Laporan Kartu</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    </head>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            margin-bottom: 50px;
        }

        .card-header {
            font-size: 18px;
            font-weight: bold;
        }

        .card-title {
            font-size: 17px;
            line-height: 25px;
        }

        .button,
        button {
            background-color: transparent;
            border: none;
            padding: 0;
            margin-left: 20px;
        }
    </style>

    <style type="text/css" media="print">
        nav {
            display: none !important;
        }
    </style>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" data-aos="fade-down">
            <a class="navbar-brand" href="#">Penerimaan Shodaqoh</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="form.php">Input Sedekah</a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Laporan
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="cetak-kartu.php">Kartu</a>
                            <a class="dropdown-item" href="cetak-sumbangan.php">Sumbangan</a>
                            <a class="dropdown-item" href="cetak-rician.php">Rician Sumbangan</a>
                        </div>
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
        <!-- End Navbar -->

        <?php
        // Ambil tanggal dari database
        $query = mysqli_query($conn, "SELECT MIN(tanggal) as awal, MAX(tanggal) as akhir FROM input WHERE 1");
        $data = mysqli_fetch_array($query);

        // Format tanggal dalam format kustom
        $format_awal = date('j', strtotime($data['awal'])) . " " . bulan(date('m', strtotime($data['awal']))) . " " . date('Y', strtotime($data['awal']));
        $format_akhir = date('j', strtotime($data['akhir'])) . " " . bulan(date('m', strtotime($data['akhir']))) . " " . date('Y', strtotime($data['akhir']));

        ?>

        <!-- Judul Halaman -->
        <div class="container d-flex align-items-center" data-aos="fade-right">
            <img src="img/logo pbl 1446 oyee.png" alt="" style="width: 110px; margin-right: 20px;">
            <div>
                <h2>PANITIA BUKA LUWUR KANJENG SUNAN KUDUS</h2>
                <h3>LAPORAN KARTU KELUAR</h3>
                <h5 id="tanggal-pilih">Tanggal
                    <?php echo isset($_GET['tanggal']) ? date('j', strtotime($_GET['tanggal'])) . " " . bulan(date('m', strtotime($_GET['tanggal']))) . " " . date('Y', strtotime($_GET['tanggal'])) : date('j') . " " . bulan(date('m')) . " " . date('Y'); ?>
                </h5>

                <!-- Tanggal untuk semua dari awal sampai akhir pada database -->
                <h5 id="tanggal-semua" style="display: none;">Tanggal
                    <?php echo $format_awal . " - " . $format_akhir; ?></h5>
            </div>
        </div>
        <!-- End Judul Halaman -->

        <!-- Content -->
        <div class="container">
            <nav class="row justify-content-between" data-aos="fade-up">
                <div class="col-md-6">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-custom" role="tab" aria-controls="nav-home" aria-selected="true" onclick="document.getElementById('tanggal-semua').style.display = 'none'; document.getElementById('tanggal-pilih').style.display = 'block';">Pilih Tanggal</a>

                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-total" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="document.getElementById('tanggal-pilih').style.display = 'none'; document.getElementById('tanggal-semua').style.display = 'block';">Total Semua</a>

                        <a href="javascript:void(0)" onclick="window.print()" class="btn btn-secondary"><i class='bx bxs-printer'></i> Print</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="date" class="form-control" name="tanggal" value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>" onchange="this.form.submit()">
                        </div>
                    </form>
                </div>
            </nav>

            <!-- Tabel Pilih Tanggal -->
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-custom" role="tabpanel" aria-labelledby="nav-home-tab" data-aos="fade-up">
                    <table id="data-table-hari-ini" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>KODE KARTU</th>
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                            $sql = "SELECT kode_kartu, COUNT(*) AS jumlah FROM input WHERE DATE(tanggal) = '$tanggal' AND kode_kartu IN ('K', 'B') GROUP BY kode_kartu";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['kode_kartu'] . "</td>";
                                    echo "<td>" . $row['jumlah'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Tabel Pilih Tanggal End -->

                <!-- Tabel Total -->
                <div class="tab-pane fade" id="nav-total" role="tabpanel" aria-labelledby="nav-profile-tab" data-aos="fade-up">
                    <table id="data-table-total" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>KODE KARTU</th>
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT kode_kartu, COUNT(*) AS jumlah FROM input WHERE kode_kartu IN ('K', 'B') GROUP BY kode_kartu";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['kode_kartu'] . "</td>";
                                    echo "<td>" . $row['jumlah'] . "</td>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Tabel Total End -->

                <!-- End Content -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
                <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
                <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

                <script>
                    // hilangkan input tanggal jika pilih Total Semua
                    $("#nav-profile-tab").click(function() {
                        $(".input-group").hide();
                    });

                    // munculkan input tanggal jika Pilih Tanggal
                    $("#nav-home-tab").click(function() {
                        $(".input-group").show();
                    });

                    $(document).ready(function() {
                        AOS.init(); // Initialize AOS
                    });
                </script>
    </body>

    </html>

<?php } else {
    header("Location: index.php");
} ?>
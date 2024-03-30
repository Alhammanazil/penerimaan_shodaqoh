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
        <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
        <title>Laporan Kartu</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    </head>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            margin-bottom: 20px;
        }

        #data-table {
            margin-top: 20px;
        }
    </style>

    <style type="text/css" media="print">
        button[onclick="window.print()"] {
            display: none !important;
        }
    </style>

    <style type="text/css" media="print">
        .dataTables_filter {
            display: none;
        }
    </style>

    <body>
        <!-- Navbar -->
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

        <!-- Judul Halaman -->
        <div class="container d-flex align-items-center">
            <img src="img/logo.png" alt="" style="width: 100px; margin-right: 20px;">
            <div>
                <h2>PANITIA BUKA LUWUR KANJENG SUNAN KUDUS</h2>
                <h3>LAPORAN RINCI PENERIMAAN SUMBANGAN</h3>
            </div>
        </div>
        <!-- End Judul Halaman -->

        <!-- Content -->
        <div class="container">
            <form action="" method="GET" class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Bentuk Sumbangan</span>
                        <select name="nama_barang" class="custom-select" id="nama_barang" onchange="this.form.submit()">
                            <option value="" disabled selected>Pilih Nama Sumbangan</option>
                            <?php if (isset($_GET['nama_barang'])) : ?>
                                <option value="semua" <?php if ($_GET['nama_barang'] == 'semua') {
                                                            echo "selected";
                                                        } ?>>Tampil Semua</option>
                            <?php else : ?>
                                <option value="semua">Tampil Semua</option>
                            <?php endif; ?>

                            <?php
                            include 'db_conn.php';
                            $query = mysqli_query($conn, "SELECT nama_barang FROM tb_barang");
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <option value="<?php echo $data['nama_barang']; ?>" <?php if (isset($_GET['nama_barang']) && $_GET['nama_barang'] == $data['nama_barang']) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                    <?php echo $data['nama_barang']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group-prepend">
                        <select name="sub_sumbangan" class="custom-select" id="sub_sumbangan" onchange="this.form.submit()">
                            <option value="" <?php if (empty($_GET['sub_sumbangan'])) {
                                                    echo 'selected';
                                                } ?>>Semua</option>
                            <option value="SHODAQOH" <?php if (isset($_GET['sub_sumbangan']) && $_GET['sub_sumbangan'] == 'SHODAQOH') {
                                                            echo 'selected';
                                                        } ?>>SHODAQOH</option>
                            <option value="AQIQAH" <?php if (isset($_GET['sub_sumbangan']) && $_GET['sub_sumbangan'] == 'AQIQAH') {
                                                        echo 'selected';
                                                    } ?>>AQIQAH</option>
                            <option value="NADZAR" <?php if (isset($_GET['sub_sumbangan']) && $_GET['sub_sumbangan'] == 'NADZAR') {
                                                        echo 'selected';
                                                    } ?>>NADZAR</option>
                    </div>
                    <?php
                    if (isset($_GET['nama_barang'])) {
                        $nama_barang = $_GET['nama_barang'];
                        if ($nama_barang == 'Kerbau' || $nama_barang == 'Kambing') {
                            if (empty($_GET['sub_sumbangan'])) {
                                $query_total = mysqli_query($conn, "SELECT COALESCE(SUM(total_jumlah), 0) as total FROM input_detail WHERE nama_barang = '$nama_barang'");
                            } else {
                                $nama_sub_sumbangan = $_GET['sub_sumbangan'];
                                $query_total = mysqli_query($conn, "SELECT COALESCE(SUM(total_jumlah), 0) as total FROM input_detail WHERE nama_barang = '$nama_barang' AND nama_sub_sumbangan = '$nama_sub_sumbangan'");
                            }
                        } elseif ($nama_barang == 'Uang') {
                            $query_total = mysqli_query($conn, "SELECT COALESCE(SUM(total_nominal), 0) as total FROM input_detail WHERE nama_barang = '$nama_barang'");
                        } else {
                            $query_total = mysqli_query($conn, "SELECT COALESCE(SUM(total_jumlah), 0) as total FROM input_detail WHERE nama_barang = '$nama_barang'");
                        }
                        $data_total = mysqli_fetch_array($query_total);
                        $total_nominal = $data_total['total'] ?? 0;
                    }
                    ?>

                    <!-- <div style="margin-left: 100px;"></div> -->
                    <span class="input-group-text">Total Sumbangan</span>
                    <div class="input-group-prepend">
                        <input type="text" class="form-control" style="max-width: 250px;" name="total_sumbangan" id="total_sumbangan" value="<?php if (isset($nama_barang) && $nama_barang == 'Uang')
                                                                                                                                                    echo number_format($total_nominal, 0, ',', '.');
                                                                                                                                                elseif (isset($total_nominal))
                                                                                                                                                    echo $total_nominal;
                                                                                                                                                ?>" readonly>
                    </div>

                    <!-- Span satuan nama_barang -->
                    <?php
                    if (isset($_GET['nama_barang']) && $_GET['nama_barang'] != 'semua') {
                        $nama_barang = $_GET['nama_barang'];
                        $query_satuan = mysqli_query($conn, "SELECT satuan FROM tb_barang WHERE nama_barang = '$nama_barang'");
                        $data_satuan = mysqli_fetch_array($query_satuan);
                        $satuan = $data_satuan['satuan'];
                    } else {
                        $satuan = 'Satuan';
                    }
                    ?>
                    <span class="input-group-text" id="hasil-satuan"><?php echo $satuan; ?></span>
                    <button type="button" onclick="window.print()" class="btn btn-secondary"><i class='bx bxs-printer'></i>
                        Print</button>
                </div>
            </form>

            <!-- Tabel -->
            <div class="container">
                <table id="data-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Register</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>‎ </th>
                            <th>‎ </th>
                            <th>‎ </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['nama_barang'])) {
                            if ($_GET['nama_barang'] == 'semua') {
                                $query_data = mysqli_query($conn, "SELECT * FROM input_detail");
                            } elseif ($_GET['nama_barang'] == 'Kerbau' || $_GET['nama_barang'] == 'Kambing') {
                                if (empty($_GET['sub_sumbangan'])) {
                                    $query_data = mysqli_query($conn, "SELECT * FROM input_detail WHERE nama_barang = '{$_GET['nama_barang']}'");
                                } else {
                                    $nama_sub_sumbangan = $_GET['sub_sumbangan'];
                                    $query_data = mysqli_query($conn, "SELECT * FROM input_detail WHERE nama_barang = '{$_GET['nama_barang']}' AND nama_sub_sumbangan = '$nama_sub_sumbangan'");
                                }
                            } else {
                                $query_data = mysqli_query($conn, "SELECT * FROM input_detail WHERE nama_barang = '{$_GET['nama_barang']}'");
                            }

                            while ($data = mysqli_fetch_array($query_data)) {
                        ?>
                                <tr>
                                    <td><?php echo $data['kodetrx']; ?></td>
                                    <td><?php echo $data['tanggal']; ?></td>
                                    <?php
                                    $query_input = mysqli_query($conn, "SELECT nama FROM input WHERE kodetrx = '" . $data['kodetrx'] . "'");
                                    $data_input = mysqli_fetch_array($query_input);
                                    ?>
                                    <td><?php echo $data_input['nama']; ?></td>
                                    <?php
                                    $query_input = mysqli_query($conn, "SELECT alamat FROM input WHERE kodetrx = '" . $data['kodetrx'] . "'");
                                    $data_input = mysqli_fetch_array($query_input);
                                    ?>
                                    <td><?php echo $data_input['alamat']; ?></td>
                                    <td><?php if ($data['nama_barang'] == 'Uang')
                                            echo number_format($data['total_nominal'], 0, ',', '.');
                                        else
                                            echo $data['total_jumlah']; ?></td>
                                    <td><?php echo $data['keterangan']; ?></td>
                                    <td><?php echo $data['nama_barang'] == 'Kerbau' || $data['nama_barang'] == 'Kambing' ? $data['nama_sub_sumbangan'] : ""; ?></td>
                                    <td><?php echo $data['nama_barang'] == 'Kerbau' || $data['nama_barang'] == 'Kambing' ? $data['atas_nama'] : ""; ?></td>
                                    <td><?php echo $data['nama_barang'] == 'Kerbau' || $data['nama_barang'] == 'Kambing' ? $data['urut_hewan'] : ""; ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- End Content -->

            <!-- Load libraries -->
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

            <script>
                $(document).ready(function() {
                    // Select2
                    $('.custom-select').select2();

                    // Initialize DataTables
                    var table = $('#data-table').DataTable({
                        ordering: false,
                        bPaginate: false,
                        bFilter: true,
                        paging: false,
                        info: false
                    });

                    // Hide input tanggal jika pilih Total Semua
                    $("#nav-profile-tab").click(function() {
                        $(".input-group").hide();
                    });

                    // Show input tanggal jika Pilih Tanggal
                    $("#nav-home-tab").click(function() {
                        $(".input-group").show();
                    });
                });
            </script>
    </body>

    </html>

<?php } else {
    header("Location: index.php");
} ?>
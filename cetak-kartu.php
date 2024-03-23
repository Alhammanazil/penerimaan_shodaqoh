<?php
session_start();
include "db_conn.php";
include "function.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
        <title>Dashboard</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
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

        .box-info {
            display: flex;
            margin: 10px;
            margin-bottom: 60px;
            gap: 15px;
            justify-content: space-between;
        }

        .box-info div {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1;
        }

        .box-info div i {
            font-size: 36px;
            line-height: 1;
            margin-bottom: 15px;
        }

        .box-info div h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .box-info div p {
            font-size: 14px;
            color: #666;
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
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="form.php">Input Sedekah</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Laporan
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="cetak-kartu.php">Kartu</a>
                            <a class="dropdown-item" href="cetak-sumbangan.php">Sumbangan</a>
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
                <h2>PANITIA BUKA LUWUR KANJENG SUNAN KUDUS</h2><br>
                <h3>LAPORAN KARTU KELUAR</h3>
                <h5>Tanggal <?php echo isset($_GET['tanggal']) ? date('j', strtotime($_GET['tanggal'])) . ' ' . bulan(date('m', strtotime($_GET['tanggal']))) . ' ' . date('Y', strtotime($_GET['tanggal'])) : date('j') . ' ' . bulan(date('m')) . ' ' . date('Y'); ?></h5>
            </div>
        </div>

        <!-- Content -->
        <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="date" class="form-control" name="tanggal" value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>" onchange="this.form.submit()">
                    </div>
                </form>
            </div>
        </div><br>
        
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-custom" role="tab" aria-controls="nav-home" aria-selected="true">Pilih Tanggal</a>

                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-total" role="tab" aria-controls="nav-profile" aria-selected="false">Total Semua</a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-custom" role="tabpanel" aria-labelledby="nav-home-tab">
                <table id="data-table-custom" class="table">
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
                        } else {
                            echo "<tr><td colspan='3'>No data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-total" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table id="data-table-total" class="table">
                    <thead>
                        <tr>
                            <th>KODE KARTU</th>
                            <th>JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                    </div>
                        <?php
                        $sql = "SELECT kode_kartu, COUNT(*) AS jumlah FROM input WHERE kode_kartu IN ('K', 'B') GROUP BY kode_kartu";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['kode_kartu'] . "</td>";
                                echo "<td>" . $row['jumlah'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No data available</td></tr>";
                        }
                        ?>
            <!-- End Content -->

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            
            <script>
                // disable
                new DataTable('#data-table', {
                    ordering: false,
                    bPaginate: false,
                    bFilter: false,
                    paging: false,
                    info: false
                });

                //datatables
                $(document).ready(function() {
                    $('#data-table').DataTable();
                });
            </script>
    </body>

    </html>

<?php } else {
    header("Location: index.php");
} ?>
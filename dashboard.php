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

        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
            margin-bottom: 30px;
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
            gap: 20px;
        }

        .box-info div {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1;
            max-width: 250px;
        }

        .box-info div i {
            font-size: 40px;
            line-height: 1;
            margin-bottom: 20px;
        }

        .box-info div h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .box-info div p {
            font-size: 16px;
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
                            <a class="dropdown-item" href="cetak.php">Kartu</a>
                            <a class="dropdown-item" href="cetak.php">Sumbangan</a>
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
        <div class="container" style="display: flex; justify-content: center;">
            <h1 style="margin: auto;">Monitor Penerimaan Shadaqoh Harian</h1>
        </div>
        <br>

        <!-- Content Start -->
        <!-- Box Info Start -->
        <div class="box-info d-flex justify-content-center">
            <div class="m-2">
                <i class='bx bxs-archive'></i>
                <span class="text">
                    <p>TOTAL SEMUA DATA MASUK</p>
                    <?php
                    include 'php/data-input.php';
                    if (isset($res) && $res instanceof mysqli_result) {
                        $total_orang = mysqli_num_rows($res);
                        mysqli_free_result($res);
                    } else {
                        $total_orang = 0;
                    }
                    ?>
                    <h3><?php echo $total_orang; ?></h3>
                </span>
            </div>
            <div class="m-2">
                <i class='bx bxs-id-card'></i>
                <span class="text">
                    <p>KARTU KELUAR <b>[HARI INI]</b></p>
                    <h3>KARTU B: 0</h3>
                </span>
                <br>
                <span class="text">
                    <h3>KARTU K: 0</h3>
                </span>
            </div>
            <div class="m-2">
                <i class='bx bxs-wallet-alt'></i>
                <span class="text">
                    <p>TOTAL SEMUA KARTU KELUAR</p>
                    <h3>Kartu B: 0</h3>
                </span>
                <br>
                <span class="text">
                    <h3>Kartu K: 0</h3>
                </span>
                </span>
            </div>
        </div>
        <!-- Box Info End -->

        <!-- Table Sumbangan Utama -->
        <div class="container">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Sumbangan Utama
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>NAMA BARANG</th>
                                        <th></th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>UANG</td>
                                        <td>CASH</td>
                                        <td>Rp - </td>
                                    </tr>
                                    <tr>
                                        <td>UANG</td>
                                        <td>QRIS BANK</td>
                                        <td>Rp - </td>
                                    </tr>
                                    <tr>
                                        <td>KERBAU</td>
                                        <td>SHODAQOH</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>KERBAU</td>
                                        <td>AQIQAH</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>KERBAU</td>
                                        <td>NADZAR</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>KAMBING</td>
                                        <td>SHODAQOH</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>KAMBING</td>
                                        <td>AQIQAH</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>KAMBING</td>
                                        <td>NADZAR</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>BERAS</td>
                                        <td> </td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>GULA</td>
                                        <td> </td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <!-- Table2 -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Sumbangan Utama</h3>
                        <br>
                        <div class="container">
                            <table id="data-table" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM tb_barang";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        $count = 1; // Initialize counter
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . $row['nama_barang'] . "</td>";
                                            echo "<td>" . $row['satuan'] . "</td>";
                                            echo "</tr>";
                                            $count++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No data available</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <br><br><br>
                            <!-- End Content -->

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
                            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('#data-table').DataTable();
                                });
                            </script>
    </body>

    </html>

<?php } else {
    header("Location: index.php");
} ?>
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
            margin-bottom: 50px;
        }

        .navbar {
            border-radius: 0;
        }

        .card-header {
            font-size: 18px;
            font-weight: bold;
        }

        .card-title {
            font-size: 17px;
            line-height: 25px;
        }

        .head-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-download {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .btn-download i {
            margin-right: 5px;
        }

        .box-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .box-info li {
            flex-basis: 30%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .box-info li i {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .box-info li h3 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .box-info li p {
            font-size: 14px;
            color: #888;
        }

        .box-info li {
            list-style-type: none;
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

        <!-- Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Dashboard</h1>
                    <br>
                    <div class="row">
                        <?php
                        include 'php/data-input.php';
                        // Check if $res is defined and is a mysqli_result object
                        if (isset($res) && $res instanceof mysqli_result) {
                            // Calculate the sum of 'sumbangan_uang' column
                            $total_uang = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $total_uang += $row['total_nominal'];
                            }
                            // Format total_uang dengan separator
                            $formatted_total_uang = number_format($total_uang, 0, '', '.');
                            mysqli_free_result($res);
                        } else {
                            $total_uang = 0;
                        }
                        ?>
                        <div class="col-md-4">
                            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                <div class="card-header">Total Sedekah</div>
                                <div class="card-body">
                                    <h5 class="card-title">Rp. <?php echo $formatted_total_uang; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header">Sumbangan Utama</div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <ul>
                                            <li>Ayam: 0 (ekor)</li>
                                            <li>Kain: 0 (meter)</li>
                                        </ul>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-header">Kartu Keluar</div>
                                <div class="card-body">
                                    <h5 class="card-title">Kartu Kecil: <i><b>0</i></b></h5>
                                    <h5 class="card-title">Kartu Besar: <i><b>0</i></b></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>

                <div class="head-title">
                    <a href="#" class="btn-download">
                        <i class='bx bxs-cloud-download'></i>
                        <span class="text">Download PDF</span>
                    </a>
                </div>
                <ul class="box-info">
                    <li>
                        <i class='bx bxs-group'></i>
                        <span class="text">
                            <p>Orang Sedekah</p>
                            <?php
                            include 'php/data-input.php';
                            // Check if $res is defined and is a mysqli_result object
                            if (isset($res) && $res instanceof mysqli_result) {
                                $total_orang = mysqli_num_rows($res);
                                mysqli_free_result($res);
                            } else {
                                $total_orang = 0;
                            }
                            ?>
                            <h3><?php echo $total_orang; ?></h3>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-calendar-check'></i>
                        <span class="text">
                            <p>Kartu Keluar</p>
                            <h3>Kartu B: 0</h3>
                        </span>
                        <br>
                        <span class="text">
                            <h3>Kartu K: 0</h3>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-wallet-alt'></i>
                        <span class="text">
                            <?php
                            include 'php/data-input.php';
                            // Check if $res is defined and is a mysqli_result object
                            if (isset($res) && $res instanceof mysqli_result) {
                                // Calculate the sum of 'sumbangan_uang' column
                                $total_uang = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $total_uang += $row['total_nominal'];
                                }
                                // Format total_uang dengan separator
                                $formatted_total_uang = number_format($total_uang, 0, '', '.');
                                mysqli_free_result($res);
                            } else {
                                $total_uang = 0;
                            }
                            ?>
                            <p>Uang Tunai</p>
                            <h3>RP. <?php echo $formatted_total_uang; ?></h3>
                        </span>
                    </li>

                </ul>
            </div>
        </div>

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
        </div>
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
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
    <title>Laporan Sumbangan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
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

    .button, button {
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#">Penerimaan Shodaqoh</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        <img src="img/logo.png" alt="" style="width: 110px; margin-right: 20px;">
        <div>
            <h2>PANITIA BUKA LUWUR KANJENG SUNAN KUDUS</h2>
            <h3>LAPORAN PENERIMAAN SUMBANGAN</h3>
            <h5>Tanggal
                <?php echo isset($_GET['tanggal']) ? date('j', strtotime($_GET['tanggal'])) . ' ' . bulan(date('m', strtotime($_GET['tanggal']))) . ' ' . date('Y', strtotime($_GET['tanggal'])) : date('j') . ' ' . bulan(date('m')) . ' ' . date('Y'); ?>
            </h5>
        </div>
    </div>

    <!-- Content -->
    <div class="container">
        <nav class="row justify-content-between">
            <div class="col-md-6">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-custom" role="tab"
                    aria-controls="nav-home" aria-selected="true">Pilih Tanggal</a>

                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-total" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Total Semua</a>
                    
                    <a href="javascript:void(0)" onclick="window.print()" class="btn btn-secondary"><i class='bx bxs-printer'></i> Print</a>
                </div>
            </div>
            <div class="col-md-3">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="date" class="form-control" name="tanggal"
                            value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>"
                            onchange="this.form.submit()">
                    </div>
                </form>
            </div>
        </nav>

        <!-- Tabel Pilih Tanggal -->
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-custom" role="tabpanel" aria-labelledby="nav-home-tab">
                <table id="data-table-hari-ini" class="table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th colspan="3" style="text-align: center;">JENIS SUMBANGAN</th>
                            <th>JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Uang</td>
                            <td>Tunai</td>
                            <td>
                                <span class="td-rp">Rp.</span>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_nominal), 0) as total_nominal FROM input_detail WHERE DATE(created_at) = '$tanggal' AND akun = 'Tunai'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_nominal = $row['total_nominal'];
                                        echo number_format($total_nominal, 0, ',', '.'); ?>
                                </span>
                            </td>
                            <td>
                                <span class="td-rp">Rp.</span>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_nominal), 0) as total_nominal FROM input_detail WHERE DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_nominal = $row['total_nominal'];
                                        echo number_format($total_nominal, 0, ',', '.'); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Non Tunai</td>
                            <td>
                                <span class="td-rp">Rp.</span>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_nominal), 0) as total_nominal FROM input_detail WHERE DATE(created_at) = '$tanggal' AND akun = 'Non-Tunai'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_nominal = $row['total_nominal'];
                                        echo number_format($total_nominal, 0, ',', '.'); ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kerbau</td>
                            <td>Shodaqoh</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kerbau' AND nama_sub_sumbangan = 'SHODAQOH' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kerbau' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Aqiqah</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = 'SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = "Kerbau" AND nama_sub_sumbangan = "AQIQAH" AND DATE(created_at) = "' . $tanggal . '"';
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Nadzar</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = 'SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = "Kerbau" AND nama_sub_sumbangan = "NADZAR" AND DATE(created_at) = "' . $tanggal . '"';
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kambing</td>
                            <td>Shodaqoh</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kambing' AND nama_sub_sumbangan = 'SHODAQOH' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kambing' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Aqiqah</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = 'SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = "Kambing" AND nama_sub_sumbangan = "AQIQAH" AND DATE(created_at) = "' . $tanggal . '"';
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Nadzar</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = 'SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = "Kambing" AND nama_sub_sumbangan = "NADZAR" AND DATE(created_at) = "' . $tanggal . '"';
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Ayam</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Ayam' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Beras</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Beras' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Gula</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Gula' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Kecap</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kecap' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Minyak Goreng</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Minyak Goreng' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Kain Biasa</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kain Biasa' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Permadani</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Permadani' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Vitrage</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Vitrage' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Kain Primisima</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kain Primisima' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Bawang Merah</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Bawang Merah' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Bawang Putih</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Bawang Putih' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Garam</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Garam' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>Pisang</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Pisang' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>Kelapa</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kelapa' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>Masker Medis</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Masker Medis' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>Masker Kn95</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Masker Kn95' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>Hand Sanitizer</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Hand Sanitizer' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>Hand Sanitizer</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Hand Sanitizer' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>Face Shield</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Face Shield' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>23</td>
                            <td>Lain-lain</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Lain-lain' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>24</td>
                            <td>Daun Jati</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Daun Jati' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>Air Mineral</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Air mineral' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>26</td>
                            <td>Rokok (Bks)</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Rokok (Bks)' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>27</td>
                            <td>Gula Merah</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Gula Merah' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>28</td>
                            <td>Kopi / Teh</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kopi / Teh' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>Roti</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Roti' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>30</td>
                            <td>Pengantar Hewan</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Pengantar Hewan' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Tabel Pilih Tanggal End -->

            <!-- Tabel Total -->
            <div class="tab-pane fade" id="nav-total" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table id="data-table-total" class="table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th colspan="3" style="text-align: center;">JENIS SUMBANGAN</th>
                            <th>JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Uang</td>
                            <td>Tunai</td>
                            <td>
                                <span class="td-rp">Rp.</span>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_nominal), 0) as total_nominal FROM input_detail WHERE nama_barang = 'Uang' AND akun = 'Tunai'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_nominal = $row['total_nominal'];
                                        echo number_format($total_nominal, 0, ',', '.'); ?>
                                </span>
                            </td>
                            <td>
                                <span class="td-rp">Rp.</span>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_nominal), 0) as total_nominal FROM input_detail WHERE nama_barang = 'Uang'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_nominal = $row['total_nominal'];
                                        echo number_format($total_nominal, 0, ',', '.'); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Non Tunai</td>
                            <td>
                                <span class="td-rp">Rp.</span>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_nominal), 0) as total_nominal FROM input_detail WHERE nama_barang = 'Uang' AND akun = 'Non-Tunai'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_nominal = $row['total_nominal'];
                                        echo number_format($total_nominal, 0, ',', '.'); ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kerbau</td>
                            <td>Shodaqoh</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kerbau' AND nama_sub_sumbangan = 'SHODAQOH'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kerbau'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Aqiqah</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = 'SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = "Kerbau" AND nama_sub_sumbangan = "AQIQAH"';
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Nadzar</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = 'SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = "Kerbau" AND nama_sub_sumbangan = "NADZAR"';
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kambing</td>
                            <td>Shodaqoh</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kambing' AND nama_sub_sumbangan = 'SHODAQOH'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kambing'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Aqiqah</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = 'SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = "Kambing" AND nama_sub_sumbangan = "AQIQAH"';
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Nadzar</td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = 'SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = "Kambing" AND nama_sub_sumbangan = "NADZAR"';
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Ayam</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Ayam'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Beras</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Beras'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Gula</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Gula'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Kecap</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kecap'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Minyak Goreng</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Minyak Goreng'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Kain Biasa</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kain Biasa'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Permadani</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Permadani'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Vitrage</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Vitrage'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Kain Primisima</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kain Primisima'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Bawang Merah</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Bawang Merah'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Bawang Putih</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Bawang Putih'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Garam</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Garam'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>Pisang</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Pisang'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>Kelapa</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kelapa' AND DATE(created_at) = '$tanggal'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>Masker Medis</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Masker Medis'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>Masker Kn95</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Masker Kn95'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>Hand Sanitizer</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Hand Sanitizer'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>Hand Sanitizer</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Hand Sanitizer'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>Face Shield</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Face Shield'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>23</td>
                            <td>Lain-lain</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Lain-lain'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>24</td>
                            <td>Daun Jati</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Daun Jati'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>Air Mineral</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Air mineral'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>26</td>
                            <td>Rokok (Bks)</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Rokok (Bks)'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>27</td>
                            <td>Gula Merah</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Gula Merah'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>28</td>
                            <td>Kopi / Teh</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Kopi / Teh'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>Roti</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Roti'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>30</td>
                            <td>Pengantar Hewan</td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="td-nominal">
                                    <?php
                                        $query = "SELECT IFNULL(SUM(total_jumlah), 0) as total_jumlah FROM input_detail WHERE nama_barang = 'Pengantar Hewan'";
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $total_jumlah = $row['total_jumlah'];
                                        echo intval($total_jumlah) ?>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Tabel Total End -->

        <!-- End Content -->

        <!-- Load libraries -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>

        <script>
        //datatables
        $(document).ready(function() {
            $('#data-table-hari-ini').DataTable();
        });

        // hilangkan input tanggal jika pilih Total Semua
        $("#nav-profile-tab").click(function() {
            $(".input-group").hide();
        });

        // munculkan input tanggal jika Pilih Tanggal
        $("#nav-home-tab").click(function() {
            $(".input-group").show();
        })
        </script>
</body>

</html>

<?php } else {
    header("Location: index.php");
} ?>
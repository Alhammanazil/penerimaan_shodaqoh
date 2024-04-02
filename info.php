<?php
session_start();
include "db_conn.php";
include "function.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

        <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />

        <!-- STYLE AWAL -->
        <style>
            body {
                font-family: "Poppins", sans-serif;
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

            a {
                color: #333;
                text-decoration: none;
            }

            form {
                max-width: 550px;
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
                background-color: #4caf50;
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
        <!-- STYLE AKHIR -->

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

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
                    <li class="nav-item active">
                        <a class="nav-link" href="form.php">Input Sedekah</a>
                    </li>
                    <li class="nav-item dropdown">
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

        <!-- Kodetrx -->
        <?php
        // Mendapatkan nilai kodetrx dari parameter URL
        $kodetrx = isset($_GET['kodetrx']) ? $_GET['kodetrx'] : '';
        ?>
        <?php
        if (!empty($_GET['kodetrx'])) {
            $kodetrx = $_GET['kodetrx'];

            $query = mysqli_query($conn, "SELECT * FROM input WHERE kodetrx='" . $kodetrx . "'");
            $data = mysqli_fetch_array($query);
            $tanggal = $data['tanggal'];
            $gelar1 = $data['gelar1'];
            $nama = $data['nama'];
            $gelar2 = $data['gelar2'];
            $alamat = $data['alamat'];
            $telepon = $data['telepon'];
            $kode_kartu = $data['kode_kartu'];
            $ambil_kartu = $data['ambil_kartu'];
        } else {
            $kodetrx = generateRandomString(6);
            $tanggal = date("Y-m-d");
            $gelar1 = null;
            $nama = null;
            $gelar2 = null;
            $alamat = null;
            $telepon = null;
            $kode_kartu = null;
            $ambil_kartu = null;
        }
        ?>
        <br>
        <h2>Informasi Sedekah</h2>
        <br>

        <form action="php/input_detail.php" method="POST">
            <input type="hidden" id="kodetrx" name="kodetrx" class="form-control" value="<?= $kodetrx; ?>" required>
            <input type="hidden" id="kodetrx_detail" name="kodetrx_detail" class="form-control" value="<?= generateRandomString(6); ?>" required>

            <i class='bx bxs-left-arrow-circle' aria-hidden="true"></i><a href="form.php" style="text-decoration: none; color:#333;"> Back</a><br><br>

            <!-- Tanggal -->
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <?php
                $query = mysqli_query($conn, "SELECT tanggal FROM input WHERE kodetrx = '$kodetrx'");
                $data = mysqli_fetch_array($query);
                $tanggal = $data['tanggal'];
                ?>
                <input type="text" id="tanggal" name="tanggal" class="form-control" value="<?php echo date('d', strtotime($tanggal)) . ' ' . bulan(date('n', strtotime($tanggal))) . ' ' . date('Y', strtotime($tanggal)); ?>" readonly>
            </div>

            <!-- Operator -->
            <div class="form-group">
                <label for="operator">Operator:</label>
                <?php
                $query = mysqli_query($conn, "SELECT operator FROM input WHERE kodetrx = '$kodetrx'");
                $data = mysqli_fetch_array($query);
                $operator = $data['operator'];
                ?>
                <input type="text" id="operator" name="operator" class="form-control" value="<?php echo $operator; ?>" readonly>
            </div>

            <!-- Gelar 1 -->
            <div class="form-group">
                <label for="gelar1">Gelar 1:</label>
                <?php
                $query = mysqli_query($conn, "SELECT gelar1 FROM input WHERE kodetrx = '$kodetrx'");
                $data = mysqli_fetch_array($query);
                $gelar1 = $data['gelar1'];
                ?>
                <input type="text" id="gelar1" name="gelar1" class="form-control" value="<?php echo $gelar1; ?>" readonly>
            </div>

            <!-- Nama -->
            <div class="form-group">
                <label for="nama">Nama:</label>
                <?php
                $query = mysqli_query($conn, "SELECT nama FROM input WHERE kodetrx = '$kodetrx'");
                $data = mysqli_fetch_array($query);
                $nama = $data['nama'];
                ?>
                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $nama; ?>" readonly>
            </div>

            <!-- Gelar 2 -->
            <div class="form-group">
                <label for="gelar2">Gelar 2:</label>
                <?php
                $query = mysqli_query($conn, "SELECT gelar2 FROM input WHERE kodetrx = '$kodetrx'");
                $data = mysqli_fetch_array($query);
                $gelar2 = $data['gelar2'];
                ?>
                <input type="text" id="gelar2" name="gelar2" class="form-control" value="<?php echo $gelar2; ?>" readonly>
            </div>

            <!-- Alamat -->
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <?php
                $query = mysqli_query($conn, "SELECT alamat FROM input WHERE kodetrx = '$kodetrx'");
                $data = mysqli_fetch_array($query);
                $alamat = $data['alamat'];
                ?>
                <input type="text" id="alamat" name="alamat" class="form-control" value="<?php echo $alamat; ?>" readonly>
            </div>

            <!-- Kartu -->
            <div class="form-group">
                <label for="kode_kartu">Kartu:</label>
                <?php
                $query = mysqli_query($conn, "SELECT kode_kartu FROM input WHERE kodetrx = '$kodetrx'");
                $data = mysqli_fetch_array($query);
                $kode_kartu = $data['kode_kartu'];
                ?>
                <input type="text" id="kode_kartu" name="kode_kartu" class="form-control" value="<?php echo $kode_kartu; ?>" readonly>
            </div>

            <!-- Total Detail Sumbangan -->
            <div class="form-group">
                <label for="detail">Total Sumbangan:</label>
                <?php
                $kodetrx = $_GET['kodetrx'];
                $query = "SELECT * FROM input_detail WHERE kodetrx='" . $kodetrx . "'";
                $result = mysqli_query($conn, $query);
                ?>
                <input type="text" id="detail" name="detail" class="form-control" value="<?php echo mysqli_num_rows($result); ?>" readonly>
            </div><br>

            <!-- Detail Sumbangan -->
            <div class="form-group">
                <label for="detail_sumbangan">Detail Sumbangan:</label>
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nama Barang</th>
                            <th scope="col" style="text-align: left;">Total</th>
                            <th scope="col" style="text-align: left;">Keterangan</th>
                            <th scope="col" style="text-align: left;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $kodetrx = $_GET['kodetrx'];
                        $query = "SELECT * FROM input_detail WHERE kodetrx='" . $kodetrx . "'";
                        $result = mysqli_query($conn, $query);
                        if (!$result) {
                            die('Error: ' . mysqli_error($conn));
                        }
                        while ($rows = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td><?= $rows['nama_barang'] ?></td>
                                <?php
                                if ($rows['nama_barang'] == 'Uang') {
                                    $total = number_format($rows['total_nominal'], 0, ',', '.') . ' ' . $rows['akun'];
                                } elseif ($rows['nama_barang'] == 'Kerbau' || $rows['nama_barang'] == 'Kambing') {
                                    $query_sub_sumbangan = "SELECT nama_sub_sumbangan FROM input_detail WHERE kodetrx_detail='" . $rows['kodetrx_detail'] . "'";
                                    $res_sub_sumbangan = mysqli_query($conn, $query_sub_sumbangan);
                                    $row_sub_sumbangan = mysqli_fetch_array($res_sub_sumbangan);
                                    $nama_sub_sumbangan = $row_sub_sumbangan['nama_sub_sumbangan'];
                                    $total = $rows['total_jumlah'] . ' - ' . $nama_sub_sumbangan;
                                } else {
                                    $query_satuan = "SELECT satuan FROM tb_barang WHERE nama_barang='" . $rows['nama_barang'] . "'";
                                    $res_satuan = mysqli_query($conn, $query_satuan);
                                    $row_satuan = mysqli_fetch_array($res_satuan);
                                    $satuan = $row_satuan['satuan'];
                                    $total = $rows['total_jumlah'] . ' ' . $satuan;
                                }
                                ?>
                                <td style="text-align: left;"><?= $total ?></td>
                                <td style="text-align: left;"><?= $rows['keterangan'] ?></td>
                                <td style="text-align: left;">
                                    <a style="display:flex;align-items:center;" href="info_input_detail.php?kodetrx_detail=<?= $rows['kodetrx_detail'] ?>&kodetrx=<?= $kodetrx ?>">
                                        <button type="button" class="btn btn-secondary" style="margin:auto;">
                                            <i style="color: white;" class="bx bxs-info-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </form><br><br>

        <!-- SCRIPT -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- SCRIPT -->
    </body>

    </html>

<?php
} else {
    header("Location: input_detail.php");
}
?>
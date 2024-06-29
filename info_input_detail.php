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

        <title>Informasi Detail Sumbangan</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
        <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />

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

            a {
                color: #333;
                text-decoration: none;
            }

            .img-bukti-pembayaran {
                max-width: 50%;
                height: auto;
                margin: 0 auto;
                display: block;
            }
        </style>
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
        // Mendapatkan nilai kodetrx dan kodetrx_detail dari parameter URL
        $kodetrx_detail = isset($_GET['kodetrx_detail']) ? $_GET['kodetrx_detail'] : '';
        $kodetrx = isset($_GET['kodetrx']) ? $_GET['kodetrx'] : '';

        // Mendapatkan informasi detail
        $query = "SELECT 
            input.nama, 
            input_detail.nama_barang, 
            input_detail.total_nominal, 
            input_detail.akun, 
            input_detail.total_jumlah, 
            input_detail.foto, 
            input_detail.nama_sub_sumbangan, 
            input_detail.atas_nama, 
            input_detail.urut_hewan, 
            input_detail.keterangan, 
            tb_barang.satuan 
        FROM input_detail 
        JOIN input ON input.kodetrx = input_detail.kodetrx 
        LEFT JOIN tb_barang ON tb_barang.nama_barang = input_detail.nama_barang 
        WHERE input_detail.kodetrx_detail = '$kodetrx_detail' 
        LIMIT 1";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = mysqli_fetch_assoc($result);
            if (!$data) {
                echo "Data tidak ditemukan.";
                exit();
            }
        } else {
            echo "Error: " . mysqli_error($conn);
            exit();
        }
        ?>

        <br>
        <h2>Informasi Detail Sedekah</h2>
        <br>

        <form>
            <i class='bx bxs-left-arrow-circle' aria-hidden="true"></i><a href="info.php?kodetrx=<?php echo $kodetrx; ?>" style="text-decoration: none; color:#333;"> Back</a><br><br>

            <!-- Nama -->
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" readonly>
            </div>

            <!-- NamaBarang -->
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="<?php echo $data['nama_barang']; ?>" readonly>
            </div>

            <!-- Akun -->
            <?php if ($data['nama_barang'] == 'Uang') { ?>
                <div class="form-group">
                    <label for="akun">Akun:</label>
                    <input type="text" id="akun" name="akun" class="form-control" value="<?php echo $data['akun']; ?>" readonly>
                </div>

                <!-- TotalNominal -->
                <div class="form-group">
                    <label for="total_nominal">Total Nominal:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" id="total_nominal" name="total_nominal" class="form-control" value="<?php echo number_format($data['total_nominal'], 0, ',', '.'); ?>" readonly>
                    </div>
                </div>
            <?php } ?>

            <!-- TotalJumlah -->
            <?php if ($data['nama_barang'] != 'Uang') { ?>
                <div class="form-group">
                    <label for="total_jumlah">Total Jumlah:</label>
                    <div class="input-group">
                        <input type="number" id="total_jumlah" name="total_jumlah" class="form-control" value="<?php echo $data['total_jumlah']; ?>" readonly>
                        <span class="input-group-text" id="hasil-satuan"><?php echo $data['satuan']; ?></span>
                    </div>
                </div>
            <?php } ?>

            <!-- NamaSubSumbangan -->
            <?php if ($data['nama_barang'] == 'Kerbau' || $data['nama_barang'] == 'Kambing') { ?>
                <div class="form-group">
                    <label for="nama_sub_sumbangan">Nama Sub Sumbangan:</label>
                    <input type="text" id="nama_sub_sumbangan" name="nama_sub_sumbangan" class="form-control" value="<?php echo $data['nama_sub_sumbangan']; ?>" readonly>
                </div>

                <!-- AtasNama -->
                <div class="form-group">
                    <label for="atas_nama">Atas Nama:</label>
                    <input type="text" id="atas_nama" name="atas_nama" class="form-control" value="<?php echo $data['atas_nama']; ?>" readonly>
                </div>

                <!-- UrutHewan -->
                <div class="form-group">
                    <label for="urut_hewan">Urut Hewan:</label>
                    <div class="input-group">
                        <input type="text" id="urut_hewan" name="urut_hewan" class="form-control" value="<?php echo number_format($data['urut_hewan'], 0, ',', '.'); ?>" readonly>
                        <span class="input-group-append">
                            <a class="btn btn-secondary btn-sm d-flex align-items-center" style="line-height: 0;" href="no_hewan.php?kodetrx_detail=<?= $kodetrx_detail ?>"><i class='bx bxs-printer'></i> Print</a>
                        </span>
                    </div>
                </div>
            <?php } ?>

            <!-- UploadFoto -->
            <div class="form-group">
                <label for="foto">Upload Foto:</label>
                <?php if ($data['foto']) { ?>
                    <img src="uploads/<?php echo $data['foto']; ?>" alt="Foto" class="img-bukti-pembayaran img-fluid rounded" style="width: 100%; height: auto;">
                <?php } else { ?>
                    <p>-</p>
                <?php } ?>
            </div>

            <!-- Keterangan -->
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea id="keterangan" name="keterangan" class="form-control" rows="2" readonly><?php echo $data['keterangan']; ?></textarea>
            </div>
        </form>
        <br><br>

        <!-- Load libraries -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: index.php");
}
?>
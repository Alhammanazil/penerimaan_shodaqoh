<?php
include "db_conn.php";
include "function.php";

// Check if kodetrx parameter is set in the URL
if (isset($_GET['kodetrx'])) {
    $kodetrx = $_GET['kodetrx'];

    // Query to fetch the data based on kodetrx
    $query = "SELECT * FROM input WHERE kodetrx = '$kodetrx'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Display the form with data for editing
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
            <title>Edit Data</title>

            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

            <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

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
            <!-- Kodetrx -->
            <?php
            // Mendapatkan nilai kodetrx dari parameter URL
            $kodetrx = isset($_GET['kodetrx']) ? $_GET['kodetrx'] : '';
            ?>
            <br>
            <div class="container">
                <a href="form.php?kodetrx=">◀ Kembali</a> <br><br>
            </div>
            <h2>Edit Data</h2>
            <br>

            <!-- Form -->
            <form action="update.php" method="POST">
                <!-- Kodetrx -->
                <input type="hidden" name="kodetrx" value="<?php echo $row['kodetrx']; ?>">

                <!-- Nama -->
                Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>

                <!-- Alamat -->
                Alamat: <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>"><br>

                <!-- Button submit -->
                <input type="submit" value="Simpan">

                <!-- Detail Sumbangan -->
                <div class="form-group mt-5">
                    <label>Detail Sumbangan:</label>
                    <div>
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
                </div>
                <?php if (mysqli_num_rows($res) > 0) { ?>
                    <a href="form.php" class="btn btn-success end" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan input data sumbangan ini?')"><i class="bx bx-check-square"></i> Selesai</a>
                <?php } ?>
            </form>

            </form>


            <!-- Load libraries -->
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        </body>

        </html>

<?php
    } else {
        echo "Data not found.";
    }
} else {
    echo "Invalid request.";
}
?>
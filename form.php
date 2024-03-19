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
        <title>Input</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

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
                max-width: 100%;
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

        <br>
        <h1 class="text-center">Input Sedekah</h1>
        <!-- Tabel -->
        <div class="container my-5">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Data Sumbangan
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success mb-4" onclick="location.href='input.php'">
                        Tambah Data +
                    </button>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Kodetrx</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Tanggal</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Nama</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Alamat</th>
                                    <th colspan="2" style="text-align: center; vertical-align: middle;">Kartu</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Detail</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Operator</th>
                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">Kode</th>
                                    <th style="text-align: center; vertical-align: middle;">ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // query data input
                                $sql = "SELECT * FROM input ORDER BY created_at DESC";
                                $res = mysqli_query($conn, $sql);
                                while ($rows = mysqli_fetch_assoc($res)) {
                                ?>
                                    <tr>
                                        <td><?= $rows['kodetrx'] ?></td>
                                        <td><?= date('d', strtotime($rows['tanggal'])) . ' ' . bulan(date('n', strtotime($rows['tanggal']))) ?></td>
                                        <td><?= $rows['nama'] ?></td>
                                        <td><?= $rows['alamat'] ?></td>
                                        <td style="text-align: center;"><?= $rows['kode_kartu'] ?></td>
                                        <td><?= $rows['ambil_kartu'] ?></td>

                                        <?php
                                        // query data input_detail
                                        $query = "SELECT * FROM input_detail WHERE kodetrx='" . $rows['kodetrx'] . "'";
                                        $result = mysqli_query($conn, $query);
                                        ?>

                                        <td style="text-align: center;"><?= mysqli_num_rows($result) ?></td>
                                        <td><?= $rows['operator'] ?></td>
                                        <td style="text-align: center;">
                                            <a href="edit.php?kodetrx=<?= $rows['kodetrx'] ?>" class="btn btn-warning btn-sm"><i class='bx bxs-edit'></i></a>
                                            <a href="delete.php?kodetrx=<?= $rows['kodetrx'] ?>" class="btn btn-danger btn-sm confirmation"><i class='bx bx-trash-alt'></i></a>
                                            <a href="print.php?kodetrx=<?= $rows['kodetrx'] ?>" class="btn btn-secondary btn-sm"><i class='bx bxs-printer'></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load libraries -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="sweetalert2.min.js"></script>

        <script>
            $('.confirmation').on('click', function() {
                return confirm('Apakah anda yakin ingin menghapus data sumbangan ini?');
            });
            $(document).ready(function() {
                $('#data-table').DataTable();
            });
            new DataTable('#data-table', {
                fixedHeader: true,
                order: [
                    [1, 'desc']
                ],
                "columnDefs": [{
                    "visible": false,
                    "targets": [0]
                }]
            });
            $(document).ready(function() {
                var table = $('#data-table').DataTable();
                $('#data-table tbody').on('click', 'tr', function() {
                    console.log(table.row(this).data());
                    var kodetrx = table.row(this).data()[0];
                    window.location.href = 'info.php?kodetrx=' + kodetrx;
                });
            });
        </script>

    </body>

    </html>


    <!-- End of file -->
<?php
}
?>
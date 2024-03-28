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

    <title>Input Detail Sumbangan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" href="sweetalert2.min.css">

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
                <li class="nav-item active">
                    <a class="nav-link" href="form.php">Input Sedekah</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Laporan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="cetak-kartu.php">Kartu</a>
                        <a class="dropdown-item" href="cetak-sumbangan.php">Sumbangan</a>
                        <a class="dropdown-item" href="cetak-rician.php">Rician Sumbangan</a>
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
        $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
        ?>
    <br>
    <div class="container">
        <a href="input.php?kodetrx=<?php echo $kodetrx; ?>">◀ Kembali</a> <br><br>
    </div>
    <h2>Form Input Detail</h2>
    <br>

    <form action="php/input_detail.php" method="POST">
        <input type="hidden" id="kodetrx" name="kodetrx" class="form-control" value="<?= $kodetrx; ?>" required>
        <input type="hidden" id="kodetrx_detail" name="kodetrx_detail" class="form-control"
            value="<?= generateRandomString(6); ?>" required>
        <input type="hidden" id="tanggal" name="tanggal" class="form-control" value="<?= $tanggal; ?>" required>
        <input type="text" id="kode_kartu" name="kode_kartu" class="form-control" required readonly>

        <!-- NamaBarang -->
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <select class="form-select" id="nama_barang" name="nama_barang" onchange="klikNamaBarang()" required>
                <option value="" disabled selected>Pilih nama barang</option>
                <?php
                    include "db_conn.php";

                    $query = mysqli_query($conn, "SELECT * FROM tb_barang");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                <option value="<?php echo $data['nama_barang']; ?>"><?php echo $data['nama_barang']; ?></option>

                <?php
                    }
                    ?>
            </select>
        </div>

        <!-- TotalNominal -->
        <div class="form-group" id="total_nominal_group">
            <label for="total_nominal">Total Nominal:</label>
            <div class="input-group">
                <span class="input-group-text">Rp.</span>
                <input type="text" id="total_nominal" name="total_nominal" class="form-control" required
                    onkeyup="getBarangKB()">
            </div>
        </div>

        <!-- Akun -->
        <div class="form-group" id="akun_group">
            <label for="akun">Akun:</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="akun" id="akun_tunai" value="Tunai" checked>
                <label class="form-check-label" for="akun_tunai">Tunai</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="akun" id="akun_non_tunai" value="Non-Tunai">
                <label class="form-check-label" for="akun_non_tunai">Non-Tunai</label>
            </div>
        </div>

        <!-- TotalJumlah -->
        <div class="form-group" id="total_jumlah_group">
            <label for="total_jumlah">Total Jumlah:</label>
            <div class="input-group">
                <input type="number" id="total_jumlah" name="total_jumlah" class="form-control" required
                    onkeyup="getBarangKB()">
                <span class="input-group-text" id="hasil-satuan">Liter</span>
            </div>
        </div>

        <!-- NamaSubSumbangan -->
        <div class="form-group" id="nama_sub_sumbangan_group">
            <label for="nama_sub_sumbangan">Nama Sub Sumbangan:</label>
            <select class="form-select" id="nama_sub_sumbangan" name="nama_sub_sumbangan" required
                onchange="showAtasNama(this.value)">
                <option value="SHODAQOH">SHODAQOH</option>
                <option value="AQIQAH">AQIQAH</option>
                <option value="NADZAR">NADZAR</option>
            </select>
        </div>

        <!-- AtasNama -->
        <div class="form-group" id="atas_nama_group" style="display: none;">
            <label for="atas_nama">Atas Nama:</label>
            <input type="text" id="atas_nama" name="atas_nama" class="form-control">
        </div>

        <!-- UrutHewan -->
        <div class="form-group" id="urut_hewan_group">
            <label for="urut_hewan">Urut Hewan:</label>
            <input type="number" id="urut_hewan" name="urut_hewan" class="form-control" readonly>
        </div>

        <!-- Keterangan -->
        <div class="form-group" id="keterangan_group">
            <label for="keterangan">Keterangan:</label>
            <textarea id="keterangan" name="keterangan" class="form-control" rows="2"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>
    </form>

    <!-- Load libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="sweetalert2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.form-select').select2();

        $("#total_jumlah_group").hide();
        $("#nama_sub_sumbangan_group").hide();
        $("#atas_nama_group").hide();
        $("#total_nominal_group").hide();
        $('#akun_group').hide();
        $('#urut_hewan_group').hide();

        // Show/hide fields based on the selected value
        $("#nama_barang").change(function() {
            var selectedValue = $(this).val();

            if (selectedValue === "") {
                $('#akun_group').hide();
                $("#total_nominal_group").hide();
                $("#total_jumlah_group").hide();
                $("#nama_sub_sumbangan_group").hide();
                $("#atas_nama_group").hide();
                $("#urut_hewan_group").hide();
                $("#total_nominal").val("");
            } else if (selectedValue === "Uang") {
                $("#total_nominal_group").show();
                $('#akun_group').show();
                $("#total_jumlah_group").hide();
                $("#nama_sub_sumbangan_group").hide();
                $("#atas_nama_group").hide();
                $("#total_nominal").prop("required", true);
                $('#akun').prop("required", true);
                $("#total_jumlah").prop("required", false);
                $("#nama_sub_sumbangan").prop("required", false);
                $("#atas_nama").prop("required", false);
                $("#total_nominal").val("");
                $("#nama_sub_sumbangan").val("");
            } else if (selectedValue === "Kerbau" || selectedValue === "Kambing") {
                $("#total_nominal_group").hide();
                $('#akun_group').hide();
                $("#total_jumlah_group").show();
                $("#nama_sub_sumbangan_group").show();
                $("#atas_nama_group").hide();
                $("#urut_hewan_group").show();
                $("#total_nominal").prop("required", false);
                $('#akun').prop("required", false);
                $("#total_jumlah").prop("required", true);
                $("#nama_sub_sumbangan").prop("required", true);
                $("#atas_nama").prop("required", false);
                $("#total_nominal").val("");
            } else {
                $("#total_nominal_group").hide();
                $('#akun_group').hide();
                $("#total_jumlah_group").show();
                $("#nama_sub_sumbangan_group").hide();
                $("#atas_nama_group").hide();
                $("#urut_hewan_group").hide();
                $("#total_nominal").prop("required", false);
                $('#akun').prop("required", false);
                $("#total_jumlah").prop("required", true);
                $("#nama_sub_sumbangan").prop("required", false);
                $("#atas_nama").prop("required", false);
                $("#total_nominal").val("");
                $("#nama_sub_sumbangan").val("");
            }
        });
    });
    </script>

    <script>
    // Select2
    $(document).ready(function() {
        $('.form-select').select2();
    });
    </script>

    <script>
    // memunculkan form atas nama
    function showAtasNama(value) {
        if (value == 'AQIQAH' || value == 'NADZAR') {
            document.getElementById('atas_nama_group').style.display = 'block';
        } else {
            document.getElementById('atas_nama_group').style.display = 'none';
        }
    }

    $('#total_nominal').keyup(function(event) {

        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function(index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });
    </script>

    <script>
    function klikNamaBarang() {
        getSatuan();
        urutHewan();
    };

    const getBarangKB = () => {

        var namaBarang = document.getElementById('nama_barang').value;
        var totalNominal = document.getElementById('total_nominal').value;
        var totalJumlah = document.getElementById('total_jumlah').value;

        totalNominal = totalNominal.replace(/[^0-9]/g, "");
        totalJumlah = totalJumlah.replace(/[^0-9]/g, "");

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'php/cek-kb.php?nama_barang=' + namaBarang + '&total_nominal=' + totalNominal +
            '&total_jumlah=' + totalJumlah, true);
        xhr.onload = function() {
            document.getElementById('kode_kartu').value = this.responseText;
        };
        xhr.send();
    }

    const getSatuan = () => {

        var namaBarang = document.getElementById('nama_barang').value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'php/cek-satuan.php?nama_barang=' + namaBarang, true);
        xhr.onload = function() {
            var satuan = document.getElementById('hasil-satuan');
            satuan.innerHTML = this.responseText;
        };
        xhr.send();
    }

    function urutHewan() {
        var nama_barang = document.getElementById('nama_barang').value;
        if (nama_barang === "Kambing" || nama_barang === "Kerbau") {
            getUrutHewan(nama_barang);
        }
    }

    const getUrutHewan = (namaHewan) => {

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'php/cek-hewan.php?namaHewan=' + namaHewan, true);
        xhr.onload = function() {
            var result = parseInt(this.responseText);
            result += 1;
            $("#urut_hewan").val(result);
        };
        xhr.send();
    }
    </script>

</body>

</html>

<?php
} else {
    header("Location: index.php");
}
?>
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
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }
    .navbar {
        border-radius: 0;
    }
    .card-header {
        font-size: 18px;
        font-weight: bold;
    }
    .card-title {
        font-size: 20px;
        /* font-weight: bold; */
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#">Penerimaan Shodaqoh</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="input.php">Input Sedekah</a>
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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Dashboard</h1>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">Total Sedekah</div>
                            <div class="card-body">
                                <h5 class="card-title">Rp. 0</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                            <div class="card-header">Total Sumbangan</div>
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
                            <div class="card-header">Total Penyumbang</div>
                            <div class="card-body">
                                <h5 class="card-title">0 Orang</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    <!-- LOAD LIBRARIES -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>


</body>
</html>

<?php }else{
	header("Location: index.php");
} ?>
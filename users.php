<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
	<title>HOME</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"/>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

	<style>
		body {
	    font-family: 'Poppins', sans-serif;
	    background-color: #f2f2f2;
	    margin: 0;
	    padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .navbar {
	    border-radius: 0;
	    }
	    .container {
	    margin-top: 20px;
	    }
	    .card {
	    margin-bottom: 70px;
        align-items: center;
	    }
        .container {
            margin-bottom: 60px;
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
                    <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="form.php">Input Sedekah</a>
                </li>
                <li class="nav-item active">
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
    <h1>Halaman Akun</h1>

	<!-- ISI KONTEN -->
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 10vh">
      	<?php if ($_SESSION['role'] == 'admin') {?>
			
	<!-- FOR ADMIN -->
	<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <img src="img/user.png" class="card-img-top" alt="admin image">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= $_SESSION['name'] ?></h5>
                </div>
            </div>
        </div>
        
                <?php include 'php/members.php';
                if (mysqli_num_rows($res) > 0) { ?>
                    <h2 class="">Users</h2> <br>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($rows = mysqli_fetch_assoc($res)) { ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $rows['name'] ?></td>
                                        <td><?= $rows['username'] ?></td>
                                        <td><?= $rows['role'] ?></td>
                                    </tr>
                                    <?php $i++;
                                } ?>
                            </tbody>
                        </table>

				<?php }?>
      	<?php }else { ?>


      		<!-- FOR USERS -->
      		<div class="card" style="width: 18rem;">
			  <img src="img/user.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['name']?>
			    </h5>
			  </div>
			</div>
      	<?php } ?>

	  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

      <script>
            $(document).ready(function() {
                var detailTable = $('#users').DataTable();
            });
        </script>

</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>
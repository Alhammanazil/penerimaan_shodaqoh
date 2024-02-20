<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>HOME</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<style>
		body {
	    font-family: Arial, sans-serif;
	    background-color: #f2f2f2;
	    margin: 0;
	    padding: 0;
	}
	.navbar {
	    border-radius: 0;
	}

	.container {
	    margin-top: 20px;
	}

	.card {
	    margin-bottom: 20px;
	}

	</style>
</head>
<body>
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
                    <a class="nav-link" href="input.php">Input Sedekah</a>
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
    <br>

	<!-- ISI KONTEN -->
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 20vh">
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
        
		<div class="col-md-9">
            <div class="p-3">
                <?php include 'php/members.php';
                if (mysqli_num_rows($res) > 0) { ?>
                    <h1 class="display-4 fs-1">Users</h1>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">User name</th>
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
                    </div>

				<?php }?>
			</div>
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
      </div>

	  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>
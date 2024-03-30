<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {   ?>

	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
		<title>Login</title>
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

		<style>
			body {
				font-family: 'Poppins', sans-serif;
			}

			h1 {
				text-align: center;
				font-weight: 600;
			}
		</style>

	</head>

	<body>

		<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
			<form class="border shadow p-3 rounded" action="php/check-login.php" method="post" style="width: 450px;" data-aos="fade-up" data-aos-duration="1000"">

      	      <h1 class=" text-center p-3">LOGIN</h1>
				<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-danger" role="alert">
						<?= $_GET['error'] ?>
					</div>
				<?php } ?>
				<div class="mb-3">
					<label for="username" class="form-label">Username</label>
					<input type="text" class="form-control" name="username" id="username" value="<?= isset($_GET['username']) ? $_GET['username'] : '' ?>">
				</div>
				<div class="mb-4">
					<label for="password" class="form-label">Password</label>
					<input type="password" name="password" class="form-control" id="password">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="show-password" onclick="showPassword()">
						<label class="form-check-label" for="show-password">
							Show Password
						</label>
					</div>
				</div>

				<div class="row g-3 align-items-center">
					<div class="col-auto">
						<button type="submit" class="btn btn-primary">LOGIN</button>
					</div>
					<div class="form-check col-auto">
						<input class="form-check-input" type="checkbox" value="" id="remember" onclick="remember()">
						<label class="form-check-label" for="remember">
							Ingat Saya
						</label>
					</div>
				</div>

				<br>

				<p>Belum memiliki akun? <a href="register.php">Daftar</a></p>
			</form>
		</div>

		<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

		<script>
			AOS.init();

			function showPassword() {
				var x = document.getElementById("password");
				if (x.type === "password") {
					x.type = "text";
				} else {
					x.type = "password";
				}
			}
		</script>

	</body>

	</html>
<?php } else {
	header("Location: dashboard.php");
} ?>
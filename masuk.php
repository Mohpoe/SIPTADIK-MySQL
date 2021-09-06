<?php
session_start();
include "config.php";

// if (isset($_SESSION['user'])) {
//     if ($_SESSION['role'] == 1) {
// 		header("Location: admin.php");
// 	} elseif ($_SESSION['role'] == 2) {
// 		header("Location: tamu.php");
// 	} elseif ($_SESSION['role'] == 3) {
// 		header("Location: pejabat.html");
// 	}
// }

if (isset($_SESSION['user']) and isset($_SESSION['pass'])) {
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	$check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengguna WHERE username='$user' AND password=Password('$pass')"));
	if ($check != 1) {
		header("Location: keluar.php");
	} else {
		if ($_SESSION['role'] == 1) {
			header("Location: admin.php");
		} elseif ($_SESSION['role'] == 2) {
			header("Location: tamu.php");
		} elseif ($_SESSION['role'] == 3) {
			header("Location: pejabat.html");
		}
		exit;
	}
} else {
	if (isset($_POST['masuk'])) {
		$user = $_POST['pengguna'];
		$pass = $_POST['sandi'];

		$check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengguna WHERE username='$user' AND password=Password('$pass')"));
		if ($check != 1) {
			$_SESSION['temp'] = "Nama dan sandi tidak sesuai!";
		} else {
			$fetch = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pengguna WHERE username='$user' AND password=Password('$pass')"));
			$_SESSION['user'] = $user;
			$_SESSION['pass'] = $pass;
			$_SESSION['role'] = $fetch['role'];
			if ($_SESSION['role'] == 1) {
				header("Location: admin.php");
			} elseif ($_SESSION['role'] == 2) {
				header("Location: tamu.php");
			} elseif ($_SESSION['role'] == 3) {
				header("Location: pejabat.html");
			}
			exit;
		}
	}
}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico">
	<title>SIPTADIK | Masuk</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="assets/css/login.css" rel="stylesheet">
</head>

<body class="text-center">

	<main class="form-signin py-4 px-5 shadow rounded">

		<?php
		if (isset($_SESSION['temp'])) {
		?>
			<div class="alert alert-warning" role="alert">
				<?= $_SESSION['temp'] ?>
			</div>
		<?php
		}
		?>

		<form method="POST">
			<img class="mb-4" src="img/title.png" alt="" width="57" height="57">
			<h1 class="h3 mb-3 fw-normal">Silakan Masuk</h1>

			<div class="form-floating">
				<input name="pengguna" type="text" class="form-control" id="inputnama" placeholder="Nama Pengguna" required autofocus>
				<label for="inputnama">Nama Pengguna</label>
			</div>
			<div class="form-floating">
				<input name="sandi" type="password" class="form-control" id="inputsandi" placeholder="Kata Sandi" required>
				<label for="inputsandi">Kata Sandi</label>
			</div>

			<button class="w-100 btn btn-lg btn-primary" type="submit" name="masuk">Masuk</button>
			<p class="mt-5 mb-3 text-muted">&copy; SIPTADIK</p>
		</form>
	</main>

</body>

</html>

<?php
unset($_SESSION['temp']);
?>
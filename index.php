<?php 
	@session_start();

	include 'config/koneksi.php';
	@$user = $_POST['user'];
	@$password = $_POST['password'];
	if (isset($_POST['login'])) {
		if ($_POST['hakses'] == "admin") {
			$table = "admin";
			$sql = mysql_query("SELECT * FROM `$table` WHERE `id_admin` = '$user' AND `password` = '$password'");
			$tampil = mysql_fetch_array($sql);
			$cek = mysql_num_rows($sql);
			if ($cek > 0) {
				$_SESSION['username'] = @$user;
				echo "<script>alert('Berhasil!');document.location.href='admin/home.php'</script>";
			}else{
				echo "<script>alert('Login Gagal!');</script>";
			}
		}elseif ($_POST['hakses'] == "petugas") {
			$table = "petugas";
			$sql = mysql_query("SELECT * FROM `$table` WHERE `id_petugas` = '$user' AND `password` = '$password'");
			$tampil = mysql_fetch_array($sql);
			$cek = mysql_num_rows($sql);
			if ($cek > 0) {
				$_SESSION['username'] = @$user;
				echo "<script>alert('Berhasil!');document.location.href='agen/home.php'</script>";
			}else{
				echo "<script>alert('Login Gagal!');</script>";
			}
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection">
	<style>
		html {
			font-family: Gillsans, Calibri, Trebuchet, sans-serif;
		}
	</style>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>OneHeart.PLN</title>
</head>
<body>
	<form action="" method="post">
	<div class="container">
		<div class="card blue-grey darken-1" style="margin-left: auto; margin-right: auto; display: block; border-radius: 9px; margin-top: 140px; width: 50%;">
			<div class="card-content white-text">
				<div class="card-title text-light" style="text-align: center;"> <h4>PT.OneHeart.PLN</h4></div>

				<div class="container" style="margin-top: 50px;">
					<div class="row">
						<div class="col s12">
							<div class="row">
								<div class="input-field col s12">
									<input type="text" placeholder="" id="user" class="validate" name="user" style="border-bottom: 1px solid white;">
									<label for="user">Username</label>
								</div>
							</div>

							<div class="row">
								<div class="input-field col s12">
									<input type="password" placeholder="" id="user" class="validate" name="password" style="border-bottom: 1px solid white;">
									<label for="user">Password</label>
								</div>
							</div>

							<div class="row">
								<div class="input-field col s12">
									<select type="text" placeholder="" id="user" class="validate" name="hakses" style="border-bottom: 1px solid white;">
										<option value="" disabled selected=>Chose your option</option>
										<option value="admin">Admin</option>
										<option value="petugas">Petugas Agen</option>
									</select>
									<label for="user" style="color: white;">Akses</label>
								</div>
							</div>

							<button class="waves-effect waves-light btn white" name="login" type="submit" style="float: right; color: #546e7a">Login</button> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>



	<!-- javascript -->
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript">
		$('select').material_select();
	</script>
</body>
</html>
<?php 

	if (!isset($_SESSION)) {
		session_start();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Login
	</title>
</head>
<body>
	<center>
			
		<fieldset>
			<legend>
				Access in your account
			</legend>

			<label>
				Email
			</label>
			<input type="email" name="email" required="">

			<br>

			<label>
				Password
			</label>
			<input type="passsord" name="passsord" required="">

			<br>

			<button type="submit">
				Access
			</button>
			<imput thype="hidden" name="action" value="login">

		</fieldset>

		<fieldset method="POST" action="../app/authController.php">
			<legend>
				Register
			</legend>

			<label>
				Name
			</label>
			<input type="tex" name="name" required="">

			<label>
				Email
			</label>
			<input type="email" name="email" required="">

			<br>

			<label>
				Password
			</label>
			<input type="passsord" name="passsord" required="">

			<br>

			<button type="submit">
				Save user
			</button>

			<imput thype="hidden" name="action" value="register">

		</fieldset>

	</center>
</body>
</html>
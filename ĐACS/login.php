<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div class="main-banner log">
		<div class="d-flex justify-content-center align-items-center vh-100">

			<form class="shadow-lg w-450 p-3"
				action="php/login.php"
				method="post">

				<h4 class="display-4 fs-1"><b>LOGIN</b></h4><br>
				<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-danger" role="alert">
						<?php echo htmlspecialchars($_GET['error']); ?>
					</div>
				<?php } ?>

				<div class="mb-3">
					<label class="form-label">Username</label>
					<input type="text"
						class="form-control"
						name="uname"
						value="<?php echo (isset($_GET['uname'])) ? htmlspecialchars($_GET['uname']) : "" ?>">
				</div>

				<div class="mb-3">
					<label class="form-label">Password</label>
					<input type="password"
						class="form-control"
						name="pass">
				</div>

				<button type="submit" class="btn btn-primary">Login</button>
				&nbsp;&nbsp;
				<a href="index.php" class="link-secondary">Back</a>
				&nbsp;&nbsp;&nbsp;
				<a href="signup.php" class="link-secondary">Sign Up</a>
				&nbsp;&nbsp;&nbsp;
				<a href="admin-login.php" class="link-secondary">Admin <i class="fa fa-cog"></i></a>
			</form>
		</div>
	</div>
</body>

</html>
<?php
	include('../conn.php');
	session_start(); // Starting Session
	if(isset($_SESSION["name"])){
	 	header('Location: pages/AdminHome.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="AazamJutt">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Signup</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<script src="../jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){			
			$("#btnSignup").click(function(){
				
				var u = $("#name");
				var l = $("#login");
				var p = $("#password1");
				var p2 = $("#password2");
				var flag = true;
				if(u.val() == ""){
					flag = false;
					u.addClass("is-invalid")
				}
				else{
					u.addClass("is-valid")
				}
				if(l.val() == ""){
					flag = false;
					l.addClass("is-invalid")
				}
				else{
					l.addClass("is-valid")
				}
				if(p.val() == ""){
					flag = false;
					p.addClass("is-invalid")
					p2.addClass("is-invalid")	
				}
				else{
					p.addClass("is-valid")
				}
				if(p.val() != p2.val()){
					flag = false;
					p2.addClass("is-invalid")
				}
				else{
					p2.addClass("is-valid")
				}
				return flag;
			});
		});
	</script>	
</head>
<body class="my-login-page">
	<?php

		if(isset($_REQUEST['btnSignup']))
		{
			$n = $_REQUEST["name"];
			$l = $_REQUEST["login"];
			$p = $_REQUEST["password1"];
			
			// Validate
			$sql = "SELECT adminid,login,name,password FROM admin WHERE login='$l'";
			$result = mysqli_query($conn,$sql);

			if (mysqli_num_rows($result) > 0) {
				echo "<script>alert('User already exist')</script>";
				die;
			}



			//store image name in database
			$query = "INSERT INTO admin (name,login,password) VALUES ('$n','$l','$p')";

			$sql = mysqli_query($conn, $query);

			if(!$sql){
				echo "data not updated";
				echo "Error: ". mysqli_error($conn);
				die;
			}
			else {
				$_SESSION["name"] = $n;
				header("Location: ./AdminHome.php");
			}

		}
	?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="Products.php">Products Site</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="./Products.php">Products</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="../img/logo.jpg" alt="bootstrap 4 login page">
					</div>
					<div class="fat shadow-lg p-3 mb-5 bg-body rounded">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="name">Name</label>
									<input id="name" type="text" class="form-control" name="name" required autofocus>
									<div class="invalid-feedback">
										Name is required
									</div>
								</div>

								<div class="form-group">
									<label for="login">Login</label>
									<input id="login" type="text" class="form-control" name="login" required autofocus>
									<div class="invalid-feedback">
										Login is required
									</div>
								</div>

								<div class="form-group">
									<label for="password1">Password</label>
									<input id="password1" type="password" class="form-control" name="password1" required data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="form-group">
									<label for="password2">Confirm Password</label>
									<input id="password2" type="password" class="form-control" name="password2" required data-eye>
									<div class="invalid-feedback">
										Both Password doesn't match
									</div>
								</div>

								<div class="form-group m-0">
									<button id="btnSignup" name="btnSignup" type="submit" class="btn btn-block btn-danger p-2">
										Signup
									</button>
								</div>
								<div class="mt-4 text-center">
									Already have an account? <a href="./SignIn.php">Login</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2017 &mdash; Your Company 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
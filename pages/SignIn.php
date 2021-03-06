<?php
	include('../conn.php');
	session_start(); // Starting Session
	if(isset($_SESSION["name"])){
		header('Location: ./AdminHome.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="AazamJutt">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<script src="../jquery.js"></script>

	<script type="text/javascript">
		
		$(document).ready(function(){	
			$("#btnLogin").click(function(){		
				var u = $("#username");
				var p = $("#password");
				var flag = true;
				
				if(u.val() == ""){
					flag = false;
					u.addClass("is-invalid")
				}
				if(p.val() == ""){
					flag = false;
					p.addClass("is-invalid")
				}
				return flag;
			});
		});
	</script>	
</head>
<body class="my-login-page">
<?php 

	if(isset($_REQUEST["btnLogin"])){
		$u = $_REQUEST["username"];
		$p = $_REQUEST["password"];

		$sql = "SELECT adminid,login,name,password FROM admin WHERE login='$u'";
		$result = mysqli_query($conn,$sql);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			if($row["login"]==$u && $row["password"]==$p){
				$_SESSION["id"] = $row["adminid"];
				$_SESSION["name"] = $row["name"];
				header('Location: .//AdminHome.php');
			}
			
		} else {
			echo "
				<script>
					alert('Invalid login or password');
				</script>
				";
		}
	}	
?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="./Products.php">Products Site</a>
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
						<img src="../img/logo.jpg" alt="logo">
					</div>
					<div class="fat shadow-lg p-3 mb-5 bg-body rounded">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="text">Username</label>
									<input id="username" type="text" class="form-control rounded" name="username" value="" required autofocus>
									<div class="invalid-feedback">
										Username can not be empty
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
									</label>
									<input id="password" type="password" class="form-control rounded" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password can not be empty
							    	</div>
								</div>

								<div class="form-end form-group m-0">
									<button id="btnLogin" type="submit" name="btnLogin" class="btn btn-primary btn-block p-2 rounded">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="./SignUp.php">Sign Up</a>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
